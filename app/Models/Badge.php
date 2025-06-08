<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Badge extends Model
{
    use HasFactory;

    protected $fillable = [ 'nome', 'matricula', 'setor', 'status', 'funcao', 'foto', 'protocolo', 'lote_id', 'mensagem', 'user_id'];

     public function user(){
    return $this->belongsTo(User::class);
}



}


