<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Crachá</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    
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
        @if(auth()->user()->role == 'Funcionário')
            <a href="{{ route('funcionario.index') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        @else
            <a href="{{ route('admin.users.dashboard') }}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        @endif
    </div>
         <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-circle-user"></i>
          <a href="#" class="text-[15px] ml-4 text-gray-200">Perfil</a>
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
  <!-- fim do side bar --> 

   <!-- Conteudo principal -->
     <div class="container  mx-auto flex-1 lg:pl-[290px]">
      
        <div class="max-w-4xl mx-auto flex-1 justify-center items-center p-4">
                  @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto w-3/4 mt-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

      <div class="bg-white p-8 rounded-lg flex flex-col md:flex-row justify-around">
        <form method="POST" action="{{ route('badges.update', $badge->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <label for="nome" class="block text-blue-800 font-semibold">Nome:</label>
            <input type="text" id="nome" name="nome" class="w-full border border-blue-500 rounded p-2 placeholder:text-gray-700" value="{{ old('nome', $badge->nome) }}" oninput="updatePreview()"  placeholder="{{ $badge->nome}}">

            <label for="matricula" class="block text-blue-800 font-semibold " value="{{ old('matricula', $badge->matricula) }}">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" class="w-full border border-blue-500 rounded p-2 placeholder:text-gray-700" oninput="updatePreview()"  placeholder="{{ $badge->matricula}}">

            <label for="funcao" class="block text-blue-800 font-semibold" value="{{ old('funcao', $badge->funcao) }}">Função</label>
            <input type="text" id="funcao" name="funcao" class="w-full border border-blue-500 rounded p-2 placeholder:text-gray-700" oninput="updatePreview()"  placeholder="{{ $badge->funcao}}">

            <label for="setor" class="block text-blue-800 font-semibold" value="{{ old('setor', $badge->setor) }}">Setor:</label>
            <input type="text" id="setor" name="setor" class="w-full border border-blue-500 rounded p-2 placeholder:text-gray-700" oninput="updatePreview()" placeholder="{{ $badge->setor}}">

            <label for="foto" class="block text-blue-800 font-semibold" value="{{ old('foto', $badge->foto) }}">Foto:</label>
            <input type="file" id="foto" name="foto" class="w-full border border-blue-500 rounded p-2 placeholder:text-gray-700" onchange="updatePreview()">

            <label for="mensagem" class="block text-blue-700 font-semibold">Mensagem:</label>
            <input type="text" id="mensagem" name="mensagem" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300 placeholder-gray-700" placeholder="Digite aqui alguma observação">
            <button type="submit" class="w-full bg-blue-800 text-white font-semibold py-2 rounded mt-5">Salvar</button>
      </form>

          <!-- Container do Crachá -->
        <div class="flex items-center justify-center mt-4">
          <div class=" teste rounded-lg p-4 text-center flex flex-col items-center justify-center"
                style="width: 55mm; height: 85mm;">
                <!-- Foto -->
                 <div class="mt-20 justify-center flex items-center flex-col">
                <img src="{{ asset('storage/' . $badge->foto) }}" id="previewFoto" class="rounded-full w-20 h-20 border-2 border-gray-400">

                <!-- Nome -->
                <p id="previewNome" class="font-bold uppercase mt-2 cracha-text text-[14px]">{{$badge->nome}}</p>

                <!-- Função/Cargo -->
                <p id="previewFuncao" class="font-bold cracha-text text-[13px]">{{$badge->funcao}}</p>

                <!-- Setor -->
                <p id="previewSetor" class="font-bold cracha-text text-[13px]">{{$badge->setor}}</p>
                    <!-- Matrícula -->
                    <p id="previewMatricula" class="font-bold cracha-text text-[13px]">{{$badge->matricula}}</p>

                 </div>
            </div>
          </div>
                </div>
<!-- fim do container -->
                
            </div>
        </div>
    </div>
   
    <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/index.js') }}"></script>

</body>
</html>
