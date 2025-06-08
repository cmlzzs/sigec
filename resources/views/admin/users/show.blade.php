<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h1 class="text-center mb-4">Detalhes do Usuário</h1>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $user->name }}</h5>
      <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">Editar</a>
      <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Deletar</button>
      </form>
    </div>
  </div>
</div>
@endsection

</body>
</html>