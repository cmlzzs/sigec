<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\User;
use App\Models\Badge;


class LoteController extends Controller
{
    public function index()
    {
        $lotes = Lote::all();
        $badges = Lote::all();
        return view('funcionario.lote.index', compact('lotes', 'badges'));
    }

    public function create()
    {
        return view('funcionario.lote.create');
    }

    public function store(Request $request) {
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
    
        Lote::create([
            'nome' => $request->input('nome'),
            'status' => $request->input('status'),
        ]);
    
        return redirect()->route('funcionario.lotes.index')->with('success', 'Lote criado com sucesso!');
    }
    

    public function verificaFechamentoLote($loteId){
    $lote = Lote::find($loteId);
  
    // logica pra fechar o lote quando chegar em 15
    if ($lote) {
        $quantidadeCrachas = Badge::where('lote_id', $lote->id)->count();
        
        if ($quantidadeCrachas >= 3) {
            $lote->update(['status' => 'Finalizado']);
            Lote::create([
                'nome' => 'Lote ' . (Lote::count() + 1),
                'status' => 'Em produção',
            ]);
        }
    }
}

    // mostra informações dos lotes de crachás
    public function show($id) {

        // encontra o lote e seus crachás
        $lote = Lote::findOrFail($id);
        $badges = Badge::where('lote_id', $id)->get();

        // retorna a view com os dados filtrados
        return view('funcionario.lote.show', compact('lote', 'badges'));
    }

    public function edit($id){
        
        $lote = Lote::findOrFail($id); 
        return view('funcionario.lote.edit', compact('lote'));
    }

    public function update(Request $request, Lote $lote)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $lote->update([
            'nome' => $request->nome,
            'status' => $request->status,
        ]);

        return redirect()->route('funcionario.index');
    }

    public function destroy(Lote $lote)
    {
        $lote->delete();
        return redirect()->route('funcionario.index');
    }
    public function NotificationLote(Request $request)
    {
        $loteId = $request->input('lote_id');

        // Atualizando o status de todos os crachás dentro do lote
        Badge::where('lote_id', $loteId)->update(['status' => 'Disponível']);

        return redirect()->back()->with('mensagem', 'Status do lote atualizado com sucesso!');
    }


}
