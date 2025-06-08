<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lote;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        // Passa todos os lotes para a view
        $lotes = Lote::all();
        return view('admin.dashboard', compact('lotes'));
    }

    public function showDashboard()
    {
        // Buscar os dados
        $totalUsuarios = User::count();  // Total de usuários cadastrados
       
       // $lotesEntregues = Lote::where('status', 'entregue')->count();  // Total de lotes entregues
     //   $lotesEmAndamento = Lote::where('status', 'em andamento')->count();  // Total de lotes em andamento
    //    $lotesNaGrafica = Lote::where('status', 'na gráfica')->count();  // Total de lotes na gráfica

        // Passar os dados para a view
        return view('admin.dashboard', compact('totalUsuarios'));
    }
}
