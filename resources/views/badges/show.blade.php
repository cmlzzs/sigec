<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu crachá</title>
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
 <div id="sidebar" class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-300 p-2 w-[300px] overflow-y-auto text-center bg-blue-950 shadow h-screen">
   <div class="text-gray-100 text-xl">
     <div class="p-2.5 mt-1 flex justify-center items-center rounded-md">
   <!--  <img src="{{ asset('images/logo.jpg') }}" alt="Imagem da logo do sigec" class="w-10 h-10 rounded-full" height="90"  width="90"/> -->
   <h1 class="font-bold text-[20px] text-center">Sigec</h1>

       <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i> <!-- Ícone para fechar em telas grandes -->
     </div>
     <hr class="my-2 text-gray-600">
     <div>
        <!-- foto de perfil e nome -->
       <div class="flex items-center p-4">
        <!-- busca a foto do usuario no banco --> 
       @if(Auth::user()->foto)
           <img src="{{ asset('storage/fotos/' . Auth::user()->foto) }}" alt="Foto do usuário" class="w-10 h-10 rounded-full object-cover">
        <!-- se ele nao tiver foto, adiciona uma foto na tela  --> 
       @else
           <img src="{{ asset('images/profile.png') }}" alt="Sem foto" class="w-10 h-10 rounded-full object-cover">
       @endif
      <span class="font-bold text-[16px] ml-3">Bem vindo (a), {{ explode(' ', Auth::user()->name)[0] }}!!</span>
      </div>

       <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
       <i class="fa-solid fa-house"></i>
       <a href="{{ route('funcionario.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
       </div>

       <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
       <i class="fa-solid fa-id-badge"></i>
         <a href="{{ route('badges.create') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Solicitar crachá</a>
       </div>
    
       <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
       <i class="fas fa-cogs"></i>
         <a href="{{ route('admin.users.configs') }}" class="text-[15px] ml-4 text-gray-200">Configurações</a>
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
  
    <div class="container mx-auto flex-1 lg:pl-[290px] bg-blue-50">
        <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto w-3/4 mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto w-3/4 mt-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-6xl mx-auto flex flex-wrap items-center justify-center gap-4 p-3">
      <!-- Container do Crachá -->
    
      <div class="flex flex-col items-center justify-center mt-4">
        
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
  </div>
  
<!-- fim do container -->
        </div>

   <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="{{ asset('js/index.js') }}"></script> 

</body>
</html>
     