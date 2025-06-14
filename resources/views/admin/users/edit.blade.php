<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuário</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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
  <div id="sidebar" class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-300 p-2 w-[310px] overflow-y-auto text-center bg-blue-950 shadow h-screen">
    <div class="text-gray-100 text-xl">
    <i class="bi bi-x flex justify-end p-3 cursor-pointer lg:hidden mr-3" onclick="Openbar()"></i> <!-- Ícone para fechar em telas grandes -->
      <div class="p-2.5 mt-1 flex flex-col justify-center items-center rounded-md">
        <img class="w-20 h-20" src="{{ asset('images/logo.jpg')}}" alt="logo do sistema">
        <h1 class="font-bold text-[15px] text-center">Sistema de gerenciamento de crachá</h1>
      </div>
      <hr class="my-2 text-gray-600">
  
        @if($user->role == 'Admin')
         <a href="{{ route('admin.dashboard')}}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="fa-solid fa-house"></i>
            <span class="text-[15px] ml-4 text-gray-200 rounded-md">Início</span>
        </div>
         </a>
        @elseif($user->role == 'Solicitante')
          <a href="{{ route('admin.users.dashboard')}}">
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                <i class="fa-solid fa-user"></i>
                <span class="text-[15px] ml-4 text-gray-200 rounded-md">Início</span>
            </div>
          </a>
        @elseif($user->role == "Funcionário")
        <a href="{{ route('funcionario.index')}}">
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                <i class="fa-solid fa-user"></i>
                <span class="text-[15px] ml-4 text-gray-200 rounded-md">Início</span>
            </div>
        </a>
        @endif

           <!-- Logout -->
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
  </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto flex-1 lg:pl-[290px]">
    <div class="max-w-6xl mx-auto flex-1 justify-center items-center p-4">
            <h2 class="text-2xl font-bold text-center text-blue-800 mb-3 rounded">Edição de Usuário</h2>
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

                    @if ($errors->any())
            <div class="bg-red-100 border mt-3 border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       
            <form class="bg-white p-5" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
              
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nome:</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email:</label>
                        <input type="text" id="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>

                   
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Nova Senha:</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                  
                    @if(auth()->user()->role == 'Admin')
                        <div class="mb-4">
                            <label for="matricula" class="block text-gray-700">Matrícula:</label>
                            <input type="text" id="matricula" name="matricula" value="{{ $user->matricula }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="setor" class="block text-gray-700">Setor:</label>
                            <input type="text" id="setor" name="setor" value="{{ $user->setor }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-gray-700">Papel:</label>
                            <select id="role" name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Funcionário" {{ $user->role == 'Funcionário' ? 'selected' : '' }}>Funcionário</option>
                                <option value="Solicitante" {{ $user->role == 'Solicitante' ? 'selected' : '' }}>Solicitante</option>
                            </select>
                        </div>
                    @endif

            
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Salvar</button>

 <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
 <script src="{{ asset('js/index.js') }}"></script>

</html>
