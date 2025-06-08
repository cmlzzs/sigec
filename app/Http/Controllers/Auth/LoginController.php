<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showLoginReset($id){
        $user = User::findOrFail($id);
        return view('auth.forgot-password', compact('user'));

    }

    public function login(Request $request)
    {
        // faz a validação dos dados
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $login = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'matricula';
        
        // verifica se existe um usuario no banco de dados
        if (Auth::attempt([$login => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::user());
        } else{
            // retorna uma mensagem de erros se os dados estiverem errados
            return back()->withErrors([
                'login_error' => 'Dados incorretos. Por favor, tente novamente.',
            ])->withInput();
        }
    }
    
    public function logout()
    {
        Auth::logout(); 
        return redirect('/login')->with('success', 'Você saiu do sistema com sucesso!');
    }
    
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'Admin') {
            return redirect()->route('admin.dashboard'); 
        } 
        elseif ($user->role === 'Solicitante') { 
            return redirect()->route('admin.users.dashboard'); 
        }
        else {
            return redirect()->route('funcionario.index'); 
        }
    }
}
