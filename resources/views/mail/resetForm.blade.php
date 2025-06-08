<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">

      <!-- Exibe mensagens de erro -->
              @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 text-red-800 text-sm p-3 rounded-lg" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

                <!-- Alerta de sucesso -->
                 @if (session('success'))
                    <div class="mb-4">
                        <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
        <h2 class="text-2xl font-bold text-center text-blue-700">Redefinição de Senha</h2>
        <p class="text-gray-600 text-center">Digite uma nova senha abaixo</p>

        <form action="{{ route('reset.password') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="token" value="{{ request()->segment(2) }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-medium" for="password">Nova Senha:</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium" for="password_confirmation">Confirme a Senha:</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-800 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Redefinir Senha
            </button>
        </form>
    </div>
</body>
</html>
