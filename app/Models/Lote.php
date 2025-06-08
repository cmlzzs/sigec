<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Badge;

class Lote extends Model
{
    use HasFactory;

      // Defina os campos que podem ser preenchidos
      protected $fillable = ['nome', 'status'];

      // Relacionamento com a tabela de badges
      public function badges()
      {
          return $this->belongsToMany(Badge::class);
      }
    
}
