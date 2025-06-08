<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu histórico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
        <a href="{{ route('admin.users.dashboard')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-id-badge"></i>
          <a href="{{ route('badges.create') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Solicitar crachá</a>
        </div>
        
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
     <i class="fa-solid fa-folder-open"></i>
          <a href="{{ route('admin.users.historico') }}" class="text-[15px] ml-4 text-gray-200">Histórico de solicitação</a>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fas fa-cogs"></i>
          <a href="{{ route('admin.users.configs') }}" class="text-[15px] ml-4 text-gray-200">Configurações</a>
        </div>

        <!-- logout -->
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

  <!-- Conteúdo Principal -->
<div class="container mx-auto flex-1 lg:pl-[290px]">
 

    <div class="max-w-4xl mx-auto flex-1 justify-center items-center p-6 rounded-lg">

    <form method="GET" action="{{ route('admin.users.historico') }}">
        <input class="p-2 border focus:outline-none px-4 py-2 focus:ring focus:ring-blue-400 focus:border-blue-500  border-gray-300 rounded-md w-full sm:max-w-xs mb-2 sm:mb-0" type="text" name="search" placeholder="Buscar por nome ou matrícula" value="{{ request('search') }}">
        <button class="bg-blue-700 text-white p-2 rounded-md sm:ml-2 w-full sm:w-auto">Buscar</button>
    </form>

 <table class="min-w-full border mt-3 border-gray-300 bg-white rounded-lg overflow-hidden shadow-md">
    <thead class="bg-blue-900">
        <tr>
            <th class="px-6 py-3 text-center text-white uppercase tracking-wide">Nome</th>
            <th class="px-6 py-3 text-center text-white uppercase tracking-wide">Protocolo</th>
            <th class="px-6 py-3 text-center text-white uppercase tracking-wide">Data da solicitação</th>
            <th class="px-6 py-3 text-center text-white uppercase tracking-wide">Status</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-gray-50">
      @if($badges->count())
        @foreach ($badges as $badge)
        <tr class="hover:bg-gray-200">
            <td class="px-6 py-3 text-center font-medium text-gray-700">
                {!! str_replace(request('search'), "<span class='bg-yellow-200 px-1 rounded'>" . request('search') . "</span>", $badge->nome) !!}
            </td>
            <td class="px-6 py-3 text-center text-gray-600">{{ $badge->protocolo }}</td>
            <td class="px-6 py-3 text-center text-gray-600">{{ $badge->created_at->format('d/m/Y') }}</td>
            <td class="px-6 py-3 text-center font-semibold 
                {{ $badge->status == 'pendente' ? 'text-yellow-600' : ($badge->status == 'aprovado' ? 'text-green-600' : 'text-red-600') }}">
                {{ $badge->status }}
            </td>
        </tr>
        @endforeach
        @else
    <p>Você ainda não solicitou nenhum crachá.</p>
@endif
    </tbody>
</table>

    </div>
</div>

<script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>