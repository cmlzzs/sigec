<?php
namespace App\Imports;

use App\Models\Badge; 
use Maatwebsite\Excel\Concerns\ToModel;

// campos que serao importados. devem estar do mesmo jeito no arquivo excel 
class BadgesImport implements ToModel
{
    public function model(array $row)
    {
        return new Badge([
            'nome'      => $row[0], 
            'matricula' => $row[1], 
            'status'    => $row[2], 
            'funcao'    => $row[3],  
            'foto'    => $row[4]  ?? null,
        ]);
    }
}
