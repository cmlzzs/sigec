<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


public function register(Request $request){

    $validatedData = $request->validate([
        'nome' => 'required|string|max:55',
        'matricula' => 'required|numeric|unique:users,matricula',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'setor' => 'required|string|max:255'
    ]);



    $setor = $validatedData['setor'];

    // definição do papel do usuário
    $role = User::count() === 0 ? 'Admin' : (
        $setor === 'Secretaria de Comunicação' ? 'Funcionário' : 'Solicitante'
    );

    // Criando um novo usuário
    $user = User::create([
        'nome' => $validatedData['nome'],
        'matricula' => $validatedData['matricula'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'setor' => $setor, // Salvando o setor corretamente
        'role' => $role,
    ]);

    // Redirecionando para a tela de login com mensagem de sucesso
    return redirect()->route('auth.login')->with('success', 'Cadastro realizado com sucesso!');
}

}
