<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Editar lote</title>
</head>
<body class="bg-blue-50">

 <!-- Botão para abrir/fechar o menu lateral -->
 <div class="bg-blue-900 flex items-center lg:hidden justify-between">
  <span class="text-white text-3xl top-4 left-4 cursor-pointer lg:hidden" onclick="Openbar()">
    <i class="fa-solid fa-bars p-3 ml-5 rounded-md"></i>
  </span>
  <h1 class="font-bold justify-center items-center mx-auto text-[15px] text-center text-white">Sistema de gerenciamento de crachá</h1>
 
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
  
       <a href="{{ route('funcionario.index')}}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
          <span class="text-[15px] ml-4 text-gray-200">Inicio</span>
        </div>
       </a>
        
         <a href="{{ route('badges.create') }}" >
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-user-plus mr-1"></i>
          <span class="text-[15px] ml-4 text-gray-200">Criar crachá</span>
        </div>
         </a>
      
         <a href="{{ route('badges.index')}}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-id-badge"></i>
          <span class="text-[15px] ml-4 text-gray-200">Todos os crachás</span>
        </div>
          </a>

         <a href="{{ route('admin.users.configs')}}">
          <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
          <i class="fa-solid fa-circle-user"></i>
          <span class="text-[15px] ml-4 text-gray-200">Perfil</span>
          </div>
        </a>
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


<!-- Conteúdo Principal -->
<div class="min-h-screen flex justify-center items-center lg:pl-[290px] bg-blue-50">
  <div class="w-full max-w-xl bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-blue-800 font-bold text-lg text-center uppercase mb-6">Editar lote</h1>

    <form action="{{ route('funcionario.lote.update', $lote->id) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label for="nome" class="block mb-2 text-blue-500">Nome:</label>
        <input type="text" id="nome" name="nome" class="w-full px-4 py-2 outline-none border border-gray-300 rounded-lg focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300" value="{{ old('nome', $lote->nome) }}" required>
      </div>

      <div>
        <label for="status" class="block mb-2 text-blue-500">Status:</label>
        <select id="status" name="status" class="w-full outline-none px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300" required>
          <option value="Em Produção" {{ $lote->status == 'Em Produção' ? 'selected' : '' }}>Em Produção</option>
          <option value="Finalizado" {{ $lote->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
          <option value="Pendente" {{ $lote->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
        </select>
      </div>

      <div>
        <label for="data" class="block mb-2 text-blue-600">Data:</label>
        <input type="date" id="data" name="data" class="w-full outline-none px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300" value="{{ old('data', $lote->data) }}">
      </div>

      <button type="submit" class="w-full outline-none bg-blue-800 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">Atualizar Lote</button>
    </form>
  </div>
</div>

<script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/index.js') }}"></script>

</body>
</html>