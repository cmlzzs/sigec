<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
  
        <a href="{{ route('admin.dashboard')}}">
          <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="fa-solid fa-house"></i>
            <span class="text-[15px] ml-4 text-gray-200">Inicio</span>
          </div>
        </a>

         <a href="{{ route('admin.users.create') }}">
          <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="fa-solid fa-user-plus mr-1"></i>
            <span class="text-[15px] ml-4 text-gray-200">Criar usuários</span>
          </div>
        </a>

        <a href="{{ route('admin.users.edit', $user->id) }}">
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
      
  
  <!-- Main Content -->
  <div class="container mx-auto flex-1 lg:pl-[290px]">
    <div class="max-w-6xl mx-auto flex-1 justify-center items-center p-4">
      <!-- Painel Administrativo -->
      <div class="mt-4 bg-white p-4 rounded-md shadow-md">
        <h2 class="text-center font-bold mb-4">Painel Administrativo</h2>
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-4 text-center">

          <div class="bg-green-600 w-full p-4 rounded-md shadow">
            <p class="text-white font-bold">Usuários cadastrados</p>
            <p class="text-white-950 text-2xl font-bold">{{ $totalUsers }}</p>
          </div>

        </div>
                <!-- Gerenciamento de Usuários -->
    
      <div class="max-w-6xl mx-auto flex-1 justify-center items-center p-4">
 <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-4">
      
        <!-- Formulário de Busca -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="w-full sm:w-auto flex items-center">
            <input class="p-2 border focus:outline-none px-4 py-2 focus:ring focus:ring-blue-400 focus:border-blue-500 border-gray-300 rounded-md w-full sm:max-w-xs" 
                type="text" name="search" placeholder="Nome ou matrícula" value="{{ request('search') }}">
            <button class="bg-blue-700 text-white p-2 rounded-md ml-2">Buscar</button>
        </form>

        <!-- Botão "Novo Usuário" -->
        <a href="{{ route('admin.users.create') }}" class="px-6 py-2 bg-blue-800 text-white font-semibold rounded-md hover:bg-blue-700 flex items-center">
            <i class="fa-solid fa-user-plus mr-1"></i> Novo usuário
        </a>
        
    </div>

       <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-blue-800 text-white font-bold">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Nome</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Papel</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Matrícula</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Setor</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-t border-gray-300">
                        <td class="px-6 py-3 text-sm">{{ $user->nome }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->role }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->matricula }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->setor }}</td>
                        <td class="mt-3 flex">
                       <a href="{{ route('admin.users.edit', $user->id) }}"><i class="bi bi-pencil-square bg-blue-100 px-3 py-1 rounded text-blue-800 ml-3"></i></a> 
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"> <i class="fa-solid fa-trash px-3 py-1 bg-red-100 rounded text-red-500 ml-3 mr-3"></i></a> 
                        </form>
                        </td> 

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
            </div>
        </div>
    </div>
    </div>
  </div>
  


 <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
 <script src="{{ asset('js/index.js') }}"></script>

</body>
</html>
