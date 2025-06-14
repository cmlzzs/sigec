<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Crachá</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
   <div id="sidebar" class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-310 p-2 w-[300px] lg:w-[350px] xl:w-[341px] overflow-y-auto text-center bg-blue-950 shadow h-screen">
    <div class="text-gray-100 text-xl">
    <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i> <!-- Ícone para fechar em telas grandes -->
      <div class="p-2.5 mt-1 flex-col flex justify-center items-center rounded-md">
     <img src="{{ asset('images/logo.jpg') }}" alt="Imagem da logo do sigec" class="w-10 h-10 rounded-full" height="90"  width="90"/>
    <h1 class="font-bold text-[15px] text-center">Sistema de gerenciamento de crachás</h1>
      </div>
      
      <hr class="my-2">
  
     <a href="{{ auth()->user()->role == 'Funcionário' ? route('funcionario.index') : route('admin.users.dashboard') }}">
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
        <span class="text-[15px] ml-4 text-gray-200 rounded-md">Início</span>
    </div>
    </a>

    @if(auth()->user()->role === 'Funcionário')
    <a href="{{ route('badges.create') }}">
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="fa-solid fa-id-badge"></i>
            <span class="text-[15px] ml-4 text-gray-200 rounded-md">Criar Crachá</span>
        </div>
    </a>
    @elseif(auth()->user()->role === 'Solicitante')
        <a href="{{ route('badges.create') }}">
            <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                <i class="fa-solid fa-id-badge"></i>
                <span class="text-[15px] ml-4 text-gray-200 rounded-md">Solicitar Crachá</span>
            </div>
        </a>
    @endif


    @if(auth()->user()->role === 'Solicitante')
        <a href="{{ route('admin.users.historico') }}">
            <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                <i class="fa-solid fa-folder-open"></i>
                <span class="text-[15px] ml-4 text-gray-200">Histórico de solicitação</span>
            </div>
        </a>
    @endif


    <a href="{{ route('admin.users.configs') }}">
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
  <!-- fim do side bar --> 

   <!-- Conteudo principal -->
     <div class="container mx-auto flex-1 lg:pl-[290px]">
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
          <div id="success-alert" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
              {{ session('success') }}
          </div>
        @endif

        <div class="bg-white p-8 shadow-lg rounded-lg flex flex-col md:flex-row mt-5 items-center justify-around">
       
        <form method="POST" action="{{ route('admin.badges.store') }}" enctype="multipart/form-data">
            @csrf
            <label for="foto" class="block text-blue-700 font-semibold">Nome:</label>
            <input type="text" id="nome" name="nome" maxlength="20" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500" value="Carima Lemos de Abrue" oninput="updatePreview()">
            <small class="text-red-600 font-semibold">Primeiro e último nome. Max: 20 caracteres</small>
            
            <label for="foto" class="block text-blue-700 font-semibold">Matrícula:</label>
            <input oninput="validateMatricula()" type="text" id="matricula" name="matricula" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500" oninput="updatePreview()">
            <small id="matriculaError" class="text-red-600 font-semibold"> </small>

            <label for="foto" class="block text-blue-700 font-semibold">Função</label>
            <input type="text" id="funcao" name="funcao" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500" oninput="updatePreview()">
            <small  class="text-red-600 font-semibold">Ex: Analista Judiciário</small>

            <label for="setor" class="block text-blue-700 font-semibold">Setor:</label>
            <input type="text" id="setor" name="setor" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500 " oninput="updatePreview()">
            <small  class="text-red-600 font-semibold">Ex: Secretaria de Comunicação</small>
            
            <label for="foto" class="block text-blue-700 font-semibold">Foto:</label>
            <input type="file" id="foto" name="foto" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500" onchange="updatePreview()">
            <small class="text-red-600 font-semibold">Tamanho:600x600</small>

            <label for="mensagem" class="block text-blue-700 font-semibold">Mensagem:</label>
            <input type="text" id="mensagem" name="mensagem" class="w-full border border-blue-500 rounded p-2 outline-none focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300 placeholder-gray-700" placeholder="Digite aqui alguma observação">
           
            <button type="submit" class="w-full bg-blue-700 text-white font-semibold py-2 rounded mt-5"  onclick="return confirm('Tem certeza que seus dados estão corretos?')">Enviar Solicitação</button>
         </form>

          <!-- Container do Crachá -->
        <div class="flex items-center justify-center mt-4 ml-5">
          <div class="teste rounded-lg p-4 text-center flex flex-col items-center justify-center shadow-lg"
                style="width: 55mm; height: 85mm;">
                <!-- Foto -->
                 <div class="mt-20 justify-center flex items-center flex-col">
                <img id="previewFoto" class="rounded-full w-20 h-20 border-2 border-gray-300">

                <!-- Nome -->
                <p id="previewNome" class="font-bold uppercase mt-2 cracha-text text-[14px]">NOME</p>

                <!-- Função/Cargo -->
                <p id="previewFuncao" class="font-bold cracha-text text-[13px]">Função</p>

                <!-- Setor -->
                <p id="previewSetor" class="font-bold cracha-text text-[13px]">Setor</p>
                    <!-- Matrícula -->
                    <p id="previewMatricula" class="font-bold cracha-text text-[13px]">Matrícula</p>
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
