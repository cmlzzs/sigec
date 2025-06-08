<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Novo usuário</title>
</head>
<body class="bg-blue-50">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-blue-900 mb-6">Cadastre-se</h1>
        
        @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Nome e Email (Lado a Lado) -->
            <div class="gap-4 mb-4">
             <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome:</label>
                <input type="text" name="nome" id="nome" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900">
            </div>
            <div>
                <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula:</label>
                <input type="text" name="matricula" id="matricula" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" oninput="validateMatricula()">
                 <small id="matriculaError" class="text-red-500"></small>
            </div>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" oninput="validateEmail()" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" required>
                <small id="emailError" class="text-red-500"></small>
            </div>
            
            <!-- Setor -->
           <label for="setor" class="block text-sm font-medium text-gray-700">Setor:</label>
            <select name="setor" id="setor" class="mb-4 block text-sm font-medium text-gray-70 w-full p-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900">
                <option value="Secretaria de Comunicação">Secretaria de Comunicação</option>
                <option value="Gestão de pessoas">Gestão de pessoas</option>
                <option value="Corregedoria geral">Corregedoria geral</option>
                <option value="Secretaria geral">Secretaria geral</option>
            </select>
            <!-- Senha e Confirmar Senha (Lado a Lado) -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
                    <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" oninput="validatePasswordMatch()" required>
                    <small id="passwordError" class="text-red-600"></small>
                </div>
                <div>
                   <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirme a Senha:</label>
                    <input type="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" name="password_confirmation" id="password_confirmation" oninput="validatePasswordMatch()">
                    <small id="passwordConfirmError" class="text-red-600"></small>
                </div>
            </div>
            
            <!-- Botão de Submissão -->
            <button type="submit" class="w-full py-3 px-4 bg-blue-900 text-white font-semibold rounded-md hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                Registrar
            </button>
        </form>
    </div>
</div>

<script src="{{ asset('js/index.js') }}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>
