<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigec - Usuário</title>
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
     
       <a href="{{ route('admin.users.dashboard')}}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
      <span class="text-[15px] ml-4 text-gray-200 rounded-md">Início</span>
        </div>
       </a>

        <a href="{{ route('badges.create') }}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-id-badge"></i>
        <span class="text-[15px] ml-4 text-gray-200 rounded-md">Solicitar crachá</span>
        </div>
        </a>
        
        <a href="{{ route('admin.users.historico') }}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
         <i class="fa-solid fa-folder-open"></i>
          <span class="text-[15px] ml-4 text-gray-200">Histórico de solicitação</span>
        </div>
        </a>

         <a href="{{ route('admin.users.edit', $user->id) }}">
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

<!-- Conteúdo Principal -->
 <div class="container mx-auto flex-1 lg:pl-[290px]">
   <div class="max-w-3xl mx-auto flex-1 justify-center items-center p-4">

        <!-- Gerenciamento de Lotes -->
        
            <h3 class="text-center font-bold text-2xl mb-3">Detalhes da solicitação</h3>
            <p class="text-center">Você pode editar seu crachá até 48h</p>

              @if($badges->count())
                @foreach ($badges as $badge)
        <div class="flex gap-6 items-center justify-center mt-4 bg-white shadow-xl rounded-lg p-6">
    <div class="flex gap-3 flex-col justify-between border border-gray-300 mb-2 p-2 rounded shadow-lg bg-blue-50">
        <p class="text-sm mb-2"><strong>Protocolo:</strong> {{ $badge->protocolo }}</p>
        <p class="mb-2">
            <strong>Status:</strong>
            <span class="p-1 rounded text-center text-white text-sm font-bold
                {{ $badge->status == 'Disponível' ? 'bg-green-600' : 'bg-red-700' }}">
                {{ $badge->status }}
            </span>
        </p>

        <p class="text-sm"><strong>Data:</strong> {{ $badge->created_at->format('d/m/Y') }}</p>
         @if($badge->created_at->diffInHours(now()) <= 100)
              <a href="{{ route('badges.edit', $badge->id) }}" class="bg-yellow-500 p-2 rounded text-center text-white">
                  Editar Solicitação
              </a>
          @endif

    </div>


      <!-- Cracha -->
      <div class="teste rounded-lg p-4 text-center flex flex-col items-center justify-center shadow-lg"
             style="width: 55mm; height: 85mm;">
          <!-- Conteúdo do crachá -->
          <div class="mt-20 justify-center flex items-center flex-col">
           <img src="{{ asset('storage/' . $badge->foto) }}" class="rounded-full w-20 h-20 border-2 border-gray-500"> 
            <p class="font-bold uppercase cracha-text mt-2 text-[14px]">{{ $badge->nome }}</p>
            <p class="font-bold cracha-text text-[13px]">{{ $badge->funcao }}</p>
            <p class="font-bold cracha-text text-[13px]">{{ $badge->setor }}</p>
            <p class="font-bold cracha-text text-[13px]">{{ $badge->matricula }}</p>
</div>
  

        </div>
<!-- fim do container -->
        </div>
  @endforeach

  
  @else
    <p class="text-center text-gray-500">Você ainda não solicitou nenhum crachá.</p>
@endif
</div>

    <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>
</html>