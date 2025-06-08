<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BadgesImport;

class ImportBadges extends Command
{
    // nome e descrição do comando para rodar no terminal
    protected $signature = 'import:badges';
    protected $description = 'Importar dados do arquivo Excel';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = storage_path('../public/dadosCrachas.xlsx'); // caminho  do arquivo aqui

        // faz a importação
        Excel::import(new BadgesImport, $filePath);

        $this->info('Arquivo importado com sucesso!');
    }
}
