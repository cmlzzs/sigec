<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
   <div id="sidebar" class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-310 p-2 w-[300px] lg:w-[350px] xl:w-[341px] overflow-y-auto text-center bg-blue-950 shadow h-screen">
    <div class="text-gray-100 text-xl">
    <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i> <!-- Ícone para fechar em telas grandes -->
      <div class="p-2.5 mt-1 flex-col flex justify-center items-center rounded-md">
     <img src="{{ asset('images/logo.jpg') }}" alt="Imagem da logo do sigec" class="w-10 h-10 rounded-full" height="90"  width="90"/>
    <h1 class="font-bold text-[15px] text-center">Sistema de gerenciamento de crachás</h1>
      </div>
      <hr class="my-2">

        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
         <i class="fa-solid fa-house"></i>
    
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        @elseif(auth()->user()->role == 'Funcionário')
            <a href="{{ route('funcionario.index') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        @else
            <a href="{{ route('admin.users.dashboard') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        @endif
      </div>

       <a href="{{ route('admin.users.configs') }}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fas fa-cogs"></i>
          <span class="text-[15px] ml-4 text-gray-200">Configurações</span>
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


  <!-- fim do side bar --> 
        <!-- Main Content -->

        <div class="container mx-auto flex-1 lg:pl-[300px]">
        <div class="max-w-5xl mx-auto flex-1 justify-center items-center p-4">
          
      @if(session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
              {{ session('success') }}
          </div>
      @endif

      <div class="bg-white p-8 rounded-lg shadow-lg">
          <div class="flex flex-col items-center mb-8">
            
          </div>

      <form action="{{ route('admin.users.configs') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" oninput="validateEmail()" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" required>
                <small id="emailError" class="text-red-500"></small>
            </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
            <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" oninput="validatePasswordMatch()" required>
            <small id="passwordError" class="text-red-600"></small>
        </div>

        <div class="mb-4">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirme a Senha:</label>
              <input type="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900" name="password_confirmation" id="password_confirmation" oninput="validatePasswordMatch()">
              <small id="passwordConfirmError" class="text-red-500"></small>
          </div>

        <button type="submit" class="bg-blue-900 text-white py-2 px-4 rounded">Salvar Alterações</button>
    </form>
</div>
</div>
</div>
    <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>