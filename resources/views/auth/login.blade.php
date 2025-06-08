<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Entrar</title>
</head>

<body class="bg-blue-50">

    <div class="flex" style="height: 90vh;">
    
        <div class="w-full max-w-md m-auto bg-white rounded p-5">   

              <!-- Exibe mensagens de erro -->
              @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 text-red-800 text-sm p-3 rounded-lg" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

                <!-- Alerta de sucesso -->
                 @if (session('success'))
                    <div class="mb-4">
                        <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
            
        <header class="flex flex-col justify-center items-center">
            <img class="w-20 h-20" src="{{ asset('images/logoBranca.png')}}" alt="img">
            <h1 class="text-blue-800 font-bold text-md text-center uppercase mt-2 mb-2">Sistema de gerenciamento de crachá</h1>
        </header>   
      <form method="POST" action="{{ route('login') }}" class="space-y-4">
      @csrf
        <div>
          <label class="block mb-2 text-blue-500" for="username">Email ou matrícula</label>
          <input type="text" id="login" name="login" class="block w-full mt-1 focus:outline-none px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300" required>
         @error('password')
          <small class="error">{{ $message }}</small>
         @enderror
        </div>
        <div>
          <label class="block mb-2 text-blue-500" for="password">Senha</label>
          <input type="password" id="password" name="password" class="block w-full mt-1 focus:outline-none px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-400 focus:border-blue-500 transition duration-300" required>
        </div>
        <div>          
          <button type="submit" class="w-full mt-5  bg-blue-800 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Entrar</button>
        </div>       
      </form>  
      <section class="mt-4">
        <a href="{{ route('forgot.password') }}" class="text-blue-800 hover:text-blue-900 text-sm float-left">Esqueceu a senha?</a>
        <a href="{{ route('register') }}" class="text-blue-800 hover:text-blue-900 text-sm float-right" href="#">Crie uma conta</a>
      </section>   

    </div>
</div>
  <div>
        <p class="text-center text-gray-500">Desenvolvido por Carima Lemos e Daniele Araújo</p>
        <p class="text-center text-gray-500">carimalemos2@gmail.com/dani.araujo2508@gmail.com</p>
  </div>
      
</body>
</html>
