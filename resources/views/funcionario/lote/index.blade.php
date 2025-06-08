<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body class="bg-blue-50 text-gray-800">
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
         <!-- Foto de Perfil e Nome do Usuário -->
        <div class="flex items-center p-4">
        @if(Auth::user()->foto)
            <img src="{{ asset('storage/fotos/' . Auth::user()->foto) }}" alt="Foto do usuário"
                 class="w-10 h-10 rounded-full object-cover">
        @else
            <img src="{{ asset('images/profile.png') }}" alt="Sem foto"
                 class="w-10 h-10 rounded-full object-cover">
        @endif
  <span class="font-bold text-[16px] ml-3">Bem vindo (a), {{ explode(' ', Auth::user()->name)[0] }}!!</span>
  </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-house"></i>
        <a href="{{ route('funcionario.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Inicio</a>
        </div>

         <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-user"></i>
        <a href="{{ route('funcionario.lote.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Lotes</a>
        </div>
        
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fa-solid fa-id-badge"></i>
          <a href="{{ route('admin.badges.index')}}" class="text-[15px] ml-4 text-gray-200 rounded-md">Crachás</a>
        </div>

        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
        <i class="fas fa-cogs"></i>
          <a href="#" class="text-[15px] ml-4 text-gray-200">Configurações</a>
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
        <div class="mx-auto p-6 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Lotes</h1>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('admin.lote.create') }}" 
               class="inline-block mb-4 px-6 py-2 bg-blue-800 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                Criar Novo Lote
            </a>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                    <thead class="bg-gray-200 text-gray-900 font-bold">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nome</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Data</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($lotes as $lote)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-6 py-3 text-sm font-bold uppercase">{{ $lote->nome }}</td>
                                <td class="px-6 py-3 text-sm">
                                    <span class="px-3 py-1 rounded-md font-semibold">
                                        {{ $lote->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold ">{{ $lote->data }}</td>
                                <td class="px-6 py-3 text-sm space-y-2">
                                @foreach ($badges as $badge)
                                <a href="{{ route('badges.show', $badge->id) }}" 
                                    class="px-3 py-1 bg-blue-500 text-white text-center rounded hover:bg-blue-600 flex flex-col">
                                    Ver
                                </a>
                                <a href="{{ route('badges.edit', $badge->id) }}" 
                                class="px-3 py-1 bg-yellow-500 text-white text-center rounded hover:bg-yellow-600 flex flex-col">
                                Editar
                                </a>
                                @endforeach
                          <form action="#" 
                                method="POST" class="flex flex-col">
                              @csrf
                              @method('DELETE')
                              <button type="submit" 
                                      class="px-3 py-1 bg-red-500 text-white text-center rounded hover:bg-red-600">
                                  Deletar
                              </button>
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

    <script src="https://kit.fontawesome.com/574318e399.js" crossorigin="anonymous"></script>
 <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
