<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Criar Novo Usuário</title>
</head>
<body class="bg-blue-50">


   <!-- Botão para abrir/fechar o menu lateral -->
 <div class="bg-blue-900 flex items-center lg:hidden justify-between">
  <span class="text-white text-3xl top-4 left-4 cursor-pointer lg:hidden" onclick="Openbar()">
    <i class="fa-solid fa-bars p-3 ml-5 rounded-md"></i>
  </span>
  <h1 class="text-xl flex justify-center font-bold items-center text-white mx-auto">Sigec</h1>
</div>

  <!-- Sidebar -->

  <div id="sidebar" class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-300 p-2 w-[300px] overflow-y-auto text-center bg-blue-950 shadow h-screen">
    <div class="text-gray-100 text-xl">
    <i class="bi bi-x ml-20 cursor-pointer lg:hidden flex justify-end mr-3" onclick="Openbar()"></i> <!-- Ícone para fechar em telas grandes -->
      <div class="p-2.5 mt-1 flex flex-col justify-center items-center rounded-md">
    <!--  <img src="{{ asset('images/logo.jpg') }}" alt="Imagem da logo do sigec" class="w-10 h-10 rounded-full" height="90"  width="90"/> -->
    <img class="w-20 h-20" src="{{ asset('images/logo.jpg')}}" alt="logo do sistema">
    <h1 class="font-bold text-[15px] text-center">Sistema de gerenciamento de crachá</h1>
      </div>
      <hr class="my-2 text-gray-600">

       <a href="{{ route('admin.dashboard')}}" >
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
        <span class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</span>
        </div>
       </a>

       <a href="{{ route('admin.users.index')}}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-users"></i>
        <span class="text-[15px] ml-4 text-gray-200 rounded-md">Gerenciar usuários</span>
        </div>
       </a>
        
            <a href="{{ route('admin.users.configs')}}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
         <i class="fa-solid fa-circle-user"></i>
          <span class="text-[15px] ml-4 text-gray-200">Perfil</span>
        </div>
            </a>

          <!-- logout -->
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <a href="#" onclick="this.closest('form').submit(); return false;">
            <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                <span class="text-[15px] text-gray-200">Sair</span>
            </div>
        </a>
    </form>

      </div>
    </div>
  </div>

  <div class="container mx-auto flex-1 lg:pl-[290px]">
  <div class="max-w-2xl mx-auto flex-1 justify-center items-center p-4 bg-white mt-5 shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-blue-900 mb-6">Novo usuário</h2>
        
        @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <!-- Nome e Email (Lado a Lado) -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome:</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" required>
                </div>
            </div>
            
            <!-- Matrícula -->
            <div class="mb-4">
                <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula:</label>
                <input type="text" name="matricula" id="matricula" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900">
            </div>
            
            <!-- Setor -->
            <div class="mb-4">
                <label for="setor" class="block text-sm font-medium text-gray-700">Setor:</label>
                <input name="setor" id="setor" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900">
            </div>

            <!-- funcao -->
            <div class="mb-4">
                <label for="funcao" class="block text-sm font-medium text-gray-700">Função:</label>
                <input name="funcao" id="funcao" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900">
            </div>
            <!-- Senha e Confirmar Senha (Lado a Lado) -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
                    <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" required>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" required>
                </div>
            </div>
            
            <!-- Papel -->
            <div class="mb-4">
                <label for="papel" class="block text-sm font-medium text-gray-700">Papel:</label>
                <select name="papel" id="papel" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900">
                    <option value="Funcionário">Solicitante</option>
                    <option value="Funcionário">Funcionário</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            <!-- Botão de Submissão -->
            <button type="submit" class="w-full py-3 px-4 bg-blue-900 text-white font-semibold rounded-md hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900">
                Criar Usuário
            </button>
        </form>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/index.js') }}"></script>
    <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
</body>
</html>
