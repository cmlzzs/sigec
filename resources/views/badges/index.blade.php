<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crachás</title>
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
    
  
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
        <a href="{{ route('funcionario.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-id-badge"></i>
          <a href="{{ route('badges.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Todos crachás</a>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-circle-user"></i>
          <a href="#" class="text-[15px] ml-4 text-gray-200">Perfil</a>
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

    <div id="container" class="max-w-6xl mx-auto flex flex-wrap items-center justify-center gap-4 p-3">
      <!-- Container do Crachá -->
      @foreach ($badges as $badge)
      <div class="flex flex-col items-center justify-center mt-4 badge">
        
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
  
        <!-- Botões fora do crachá -->
        <div class="mt-2 flex gap-2 no-print">
           <a href="{{ route('badges.edit', $badge->id) }}" class="bg-blue-800 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-2 rounded">
            <i class="bi bi-pencil-square mr-1"></i> Editar
          </a>
        </div>
      </div>
      @endforeach
  </div>

<div class="mt-2 flex justify-center gap-6">
        <button class="text-blue-900 px-3 py-3 rounded border border-gray-300 text-lg" onclick="prev()">
            <i class="fa-solid fa-backward"></i>
        </button>
        <p id="pageCount" class="flex justify-center items-center text-lg font-semibold"> 1 de 4</p>
        <button class="text-blue-900 px-3 py-3 rounded border border-gray-300 text-lg" onclick="next()">
            <i class="fa-solid fa-forward"></i>
        </button>
    </div>

<!-- fim do container -->
        </div>

        <script>
let index = 0;
const items = document.querySelectorAll(".badge");
const itemsPerPage = 5;
const totalPages = Math.ceil(items.length / itemsPerPage);
const pageCount = document.getElementById("pageCount");

function updateView() {
    items.forEach(item => item.style.display = "none"); 
    for (let i = index; i < index + itemsPerPage && i < items.length; i++) {
        items[i].style.display = "flex";
    }
    pageCount.innerText = `${Math.ceil(index / itemsPerPage) + 1} de ${totalPages}`;
}

function next() {
    if (index + itemsPerPage < items.length) {
        index += itemsPerPage;
        updateView();
    }
}

function prev() {
    if (index - itemsPerPage >= 0) {
        index -= itemsPerPage;
        updateView();
    }
}

updateView();

</script>

   
 <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
