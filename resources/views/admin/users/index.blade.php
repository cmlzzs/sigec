<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar usuários</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
        <a href="{{ route('admin.dashboard')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
   <i class="fa-solid fa-users"></i>
        <a href="{{ route('admin.users.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Gerenciar usuários</a>
        </div>
        

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
   <i class="fa-solid fa-circle-user"></i>
          <a href="{{ route('admin.users.configs')}}" class="text-[15px] ml-4 text-gray-200">Perfil</a>
        </div>

        <!-- Logout -->
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <form action="{{ route('logout') }}" method="POST" style="display: inline; ">
            @csrf
            <a href="#" class="flex items-center rounded-md" onclick="this.closest('form').submit(); return false;">
            <i class="fa-solid fa-right-from-bracket mr-2"></i>
                <span class="text-[15px]">Sair</span> 
            </a>
        </form>
        </div>
      </div>
    </div>
  </div>


  <div class="container mx-auto flex-1 lg:pl-[290px]">
  <div class="max-w-6xl mx-auto flex-1 justify-center items-center p-4">
    <div class="mx-auto p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Usuários</h1>
        
        @if (session('success'))
            <div class="bg-blue-100 border border-blue-400 text-blue-800 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="{{ route('admin.users.create') }}" class="inline-block mb-4 px-6 py-2 bg-blue-800 text-white font-semibold rounded-md hover:bg-blue-700">
            <i class="fa-solid fa-user-plus mr-1"></i> Novo usuário
        </a>
        
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
                        <td class="px-6 py-3 text-sm">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->role }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->matricula }}</td>
                        <td class="px-6 py-3 text-sm">{{ $user->setor }}</td>
                        <td>
                        <a href="{{ route('admin.users.index') }}"><i class="bi bi-pencil-square bg-blue-100 px-3 py-1 rounded text-blue-800 ml-3"></i></a> 
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"> <i class="fa-solid fa-trash bg-red-100 px-3 py-1 rounded text-red-500 ml-3 mr-2"></i></button>
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
    
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
</body>
</html>
