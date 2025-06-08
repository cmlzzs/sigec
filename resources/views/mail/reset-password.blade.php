<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-800 text-white flex justify-center items-center min-h-screen">

    <div class="bg-white text-blue-800 p-6 rounded-lg shadow-md w-96 text-center">
        <h2 class="text-2xl font-semibold mb-4">Redefinição de Senha</h2>
        <p class="mb-4">Você solicitou a redefinição de senha. Clique no link abaixo para continuar:</p>
        <a href="{{ $link }}" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-700">Redefinir Senha</a>
        <p class="text-sm text-gray-600 mt-4">Se você não solicitou essa alteração, ignore este e-mail.</p>
    </div>

</body>
</html>
