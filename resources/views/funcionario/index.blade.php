<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigec - Funcionário</title>
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
  </div>


  <!-- Main Content -->
  <div class="container mx-auto flex-1 lg:pl-[290px]">
    <div class="max-w-6xl mx-auto flex-1 justify-center items-center p-4">
      <!-- Painel Administrativo -->
      <div class="mt-5 bg-white p-4 rounded-md shadow-md">
        <h2 class="text-center font-bold mb-4">Painel Administrativo</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-center">
          <div class="bg-blue-600 p-4 rounded-md shadow">
            <p class="text-white">Lotes finalizados</p>
            <p class="text-white text-2xl font-bold">{{ $finalizados }}</p>
          </div>
          <div class="bg-green-600 p-4 rounded-md shadow">
            <p class="text-white">Lotes em produção</p>
            <p class="text-white text-2xl font-bold">{{ $producao }}</p>
          </div>
          <div class="bg-purple-600 p-4 rounded-md shadow">
            <p class="text-white">Lotes na gráfica</p>
            <p class="text-white text-2xl font-bold">{{ $grafica }}</p>
          </div>
        </div>
      

      <!-- Gerenciamento de Lotes -->
      <div class="mt-4 p-4">
    <div class="max-w-6xl mx-auto flex-1 justify-center items-center p-4">
        <h2 class="text-center font-bold mb-4">Gerenciamento de Lotes</h2>
    </div>

 <div class="w-full max-w-4xl mx-auto"> 
    <div id="container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"> 
      @foreach ($lotes as $lote)
            <div class="bg-white border border-gray-300 rounded-lg p-8 text-center hidden min-h-[250px]"> 
                <div class="bg-gray-200 rounded-lg flex items-center justify-center mb-5 h-20"> 
                    <img src="{{ asset('images/icons8-crachá-100.png') }}" alt="icone de crachá" class="w-14 h-14 rounded-full"> 
                </div>
                <h3 class="font-bold text-xl">{{ $lote->nome }}</h3> 
                <p class="text-gray-700 text-lg"><strong>Status:</strong> {{ $lote->status }}</p>
                <p class="text-gray-700 text-lg"><strong>Data:</strong> {{ $lote->created_at->format('d/m/Y') }}</p>

                <div class="flex p-3 gap-2 mt-6 justify-center"> 
                    <a href="{{ route('funcionario.lote.show', $lote->id) }}" class="text-green-700 bg-green-200 px-4 py-2 rounded hover:bg-green-300 transition">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('funcionario.lote.edit', $lote->id) }}" class="text-blue-700 bg-blue-200 px-4 py-2 rounded hover:bg-blue-300 transition">
                        <i class="bi bi-pencil-square"></i> 
                    </a>

                    <button class="hover:bg-purple-400 bg-purple-300 text-purple-700 transition text-sm font-semibold px-4 py-2 rounded inline-flex items-center" 
                        onclick="window.location.href='/export-badge/{{ $lote->id }}'">
                       <i class="fa-solid fa-file-pdf"></i>
                    </button>
    
                      <form action="/lote/status" method="POST">
                        @csrf
                          <input type="hidden" name="lote_id" value="{{ $lote->id }}">
                            <button type="submit" class="hover:bg-orange-400 h-full bg-orange-300 text-orange-700 transition text-sm font-semibold px-4 py-2 rounded inline-flex items-center">
                              <i class="fa-solid fa-bell"></i> 
                            </button>
                        </form>          
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-6 flex justify-center gap-6">
        <button class="text-blue-900 px-3 py-3 rounded border border-gray-300 text-lg" onclick="prev()">
            <i class="fa-solid fa-backward"></i>
        </button>
        <p id="pageCount" class="flex justify-center items-center text-lg font-semibold"> 1 de 4</p>
        <button class="text-blue-900 px-3 py-3 rounded border border-gray-300 text-lg" onclick="next()">
            <i class="fa-solid fa-forward"></i>
        </button>
    </div>
</div>
    
</div>
            </div>
        </div>
    </div>
    </div>
  </div>


  
<script>
let index = 0;
const items = document.querySelectorAll("#container > div");
const itemsPerPage = 3;
const totalPages = Math.ceil(items.length / itemsPerPage);
const pageCount = document.getElementById("pageCount");

function updateView() {
    items.forEach(item => item.classList.add("hidden"));
    for (let i = index; i < index + itemsPerPage && i < items.length; i++) {
        items[i].classList.remove("hidden");
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
 <script src="{{ asset('js/index.js') }}"></script>

</body>
</html>
