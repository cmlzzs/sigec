<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller 
{
    public function index(Request $request){
        $search = $request->input('search');

        // busca usuarios
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('nome', 'like', "%{$search}%")
                         ->orWhere('matricula', 'like', "%{$search}%");
        })->get();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
       
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'matricula' => 'nullable|string|unique:users,matricula',
        'setor' => 'nullable|string',
    ]);

    User::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'Funcionário',
        'matricula' => $request->matricula,
        'setor' => $request->setor,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Usuário criado com sucesso!');
    }

    public function show(User $user){
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user){

    $users = User::all(); 
    return view('admin.users.edit', compact('user', 'users')); 
    }

    public function update(Request $request, User $user) {
    // validação dos campos
    $request->validate([
    'nome' => 'nullable|string|max:255',
    'email' => 'nullable|email|unique:users,email,' . $user->id,
    'password' => 'nullable|min:6',
    'matricula' => 'required|unique:users,matricula,' . $user->id,
    'setor' => 'nullable|string|max:255', 
    'role' => 'nullable|string' // 
], [
    'matricula.required' => 'A matrícula é obrigatória.',
    'matricula.unique' => 'Ops! A matrícula já foi utilizada.'
]);


    // os campos enviados pelo formulário
    $data = $request->only(['nome', 'email', 'password', 'matricula', 'setor', 'role']);
    

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    } else {
        unset($data['password']); 
    }

    // atualizando o usuário
    $user->update($data);

    // redirecionando com mensagem de sucesso
    return redirect()->back()->with('success', 'Dados do usuário atualizados com sucesso.');
}

    public function destroy(User $user){
        $user->delete();
        return redirect()->back()->with('success', 'Usuário deletado com sucesso.');
    }

    public function historico(Request $request){
        $search = $request->input('search');

     // Busca crachás filtrados pelo nome ou outro critério
    $badges = Badge::when($search, function ($query) use ($search) {
        return $query->where('nome', 'like', "%{$search}%")
                     ->orWhere('user_id', function ($subquery) use ($search) {
                         $subquery->select('id')->from('users')
                                  ->where('nome', 'like', "%{$search}%");
                     });
    })->get();
        return redirect()->route('admin.users.historico', compact('search', 'dates'));

    }

    public function showForgotPasswordForm(){
        return view('auth.forgot-password');
}


    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $email = $request->email;

        $token = Str::random(60);

       DB::table('password_reset_tokens')->upsert([
        ['email' => $request->email, 'token' => $token, 'created_at' => now()]
        ], ['email'], ['token', 'created_at']);
        $resetLink = url('/reset-password/' . $token);

        Mail::to($email)->send(new ResetPasswordMail($resetLink));

        //Log::info('Solicitação de recuperação de senha recebida: ' . $request->email);
        return back()->with('message', 'Um link de redefinição de senha foi enviado para o seu e-mail.');
    }

    public function showResetForm(){
        return view('mail.resetForm');
    }


public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    $resetData = DB::table('password_reset_tokens')->where('token', $request->token)->first();

    if (!$resetData) {
        return back()->withErrors(['token' => 'Token inválido ou expirado.']);
    }

    $user = User::where('email', $resetData->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();

    DB::table('password_reset_tokens')->where('email', $resetData->email)->delete();

    return back()->with('message', 'Senha redefinida com sucesso!');
}

}


    

