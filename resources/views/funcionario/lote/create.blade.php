<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar lotes</title>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Lote</h1>

    <!-- Exibe mensagens de erro de validação -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de criação de lote -->
    <form action="{{ route('funcionario.lote.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nome">Nome do Lote</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status do Lote</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="Em Produção" {{ old('status') == 'Em Produção' ? 'selected' : '' }}>Em Produção</option>
                <option value="Concluído" {{ old('status') == 'Concluído' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <div class="form-group">
            <label for="data">Data de Entrega</label>
            <input type="date" name="data" id="data" class="form-control" value="{{ old('data') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Criar Lote</button>
    </form>
</div>
@endsection



</body>
</html>