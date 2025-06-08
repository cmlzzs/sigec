<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Alterar senha</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-blue-50">

    <div class="max-6xl mx-auto bg-white p-6 rounded-lg shadow-md ">
        
        @if(session('message'))
            <div class="mt-2 p-3 bg-green-200 text-green-800 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mt-2 p-3 bg-red-200 text-red-800 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-2 mt-3">Recuperar Senha</h2>
    <p class="text-gray-600 text-center">Informe seu e-mail para receber um link de redefinição.</p>

    <form action="{{ route('forgot.password') }}" method="POST" class="mt-4">
        @csrf
        <label class="block text-gray-700 font-medium">E-mail:</label>
        <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500">
        
        <button type="submit" class="w-full mt-3 bg-blue-800 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Enviar Link
        </button>
      <a href="{{ route('auth.login') }}" class="text-white bg-blue-800 py-2 rounded-lg mt-3 flex items-center justify-center hover:bg-blue-700 transition">Voltar</a>
    </form>
</div>

</body>

</html>
