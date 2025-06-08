<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;
use App\Models\Lote;
use App\Helpers\MyFpdf;
use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Auth;


class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('badges.index', compact('badges'));
    }

    public function create(){
        return view('badges.create');
    }

    public function store(Request $request){
        //dd($request->all());
        $data = $request->validate([
            'matricula' => 'required|string|max:9|unique:badges,matricula',
            'nome' => 'required|string|max:50',
            'setor' => 'required|string|max:50',
            'status' => 'nullable|string',
            'funcao' => 'required|string|max:50',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'lote_id' => 'nullable|integer',
            'protocolo' => 'string|max:20|unique:badges,protocolo|regex:/^[A-Z0-9]+$/',
             'mensagem' => 'nullable|string',

        ]);
         
        //pega o usuario logado
        $usuario = auth()->user();

       
         // Verifica o papel do usuário
        if ($usuario->role === 'Solicitante' && $data['matricula'] !== $usuario->matricula) {
            return back()->withErrors(['error' => 'Não é permitido a solicitação de crachás para outras pessoas!']);
        }

        //processa a foto e salva na pasta public
        if ($request->hasFile('foto')) {

            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

             // último lote criado
            $lastLote = Lote::latest()->first();

            // contagem de crachás no último lote (se existir)
            $quantidadeCrachas = $lastLote ? Badge::where('lote_id', $lastLote->id)->count() : 0;

            if ($quantidadeCrachas == 2) {
                // atualiza o status do lote 
                $lastLote->update(['status' => 'Enviar para a gráficas']);

                // cria um novo lote
                $lastLote = Lote::create([
                    'nome' => 'Lote ' . (Lote::count() + 1), // contagem automática
                    'status' => 'Em produção',
                ]);
            }
            // verificar se o protocolo já existe antes de criar
            do {
                $protocolo = strtoupper(Str::random(10));
            } while (Badge::where('protocolo', $protocolo)->exists());
            
            $data['protocolo'] = $protocolo;
            $data['user_id'] = auth()->id();

            // novos crachás ao lote atualizado/criado
            $data['lote_id'] = $lastLote->id;

            Badge::create($data);

        return redirect()->route('badges.create')->with('success', 'Crachá criado com sucesso!');
    }

  
    // mostrar informações dos lotes de crachás
    public function show($id) {

          // mostra detalhes do cracha solicitado
          $badge = Badge::findOrFail($id);
         
          // retorna a view com os dados filtrados
          return view('badges.show', compact('badge'));
    }

    public function edit(Badge $badge){
        return view('badges.edit', compact('badge'));
    }

    public function update(Request $request, Badge $badge) {

        if ($badge->created_at->diffInHours(now()) > 100) {
        return redirect()->back()->with('error', 'O prazo de 2 dias para edição já expirou.');
        }

        $data = $request->validate([
            'nome' => 'nullable|string|max:50',
            'matricula' => 'nullable|numeric|unique:badges,matricula',
            'setor' => 'nullable|string|max:50',
            'status' => 'nullable|string',
            'funcao' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'lote_id' => 'nullable|integer',
            'protocolo' => 'string|max:20|unique:badges,protocolo|regex:/^[A-Z0-9]+$/',
            'mensagem' => 'nullable|string'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $data = array_filter($data, function ($value) {
                return $value !== null && $value !== '';
            });

        // os campos não alterados mantenham os dados antigos
        $data = array_merge($badge->toArray(), $data);
        $badge->update($data);

        return redirect()->back()->with('success', 'Crachá atualizado com sucesso!');

    }

    public function destroy(Badge $badge){
        $badge->delete();
        return redirect()->route('badges.index');
    }


    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new MyFpdf();
    }

    public function export($loteId) {

    $badges = Badge::where('lote_id', $loteId)->get();



    $this->fpdf->SetMargins(5, 5, 5);
    $this->fpdf->SetAutoPageBreak(false);
    $this->fpdf->AddPage();

    foreach ($badges as $index => $badge) {
       $x = 75; // posição horizontal fixa
       $y = 10 + $index * 100; // um embaixo do outro

        $this->fpdf->Ellipse($x + 25, $y + 30, 25, 25);

        // adicionar foto do usuário dentro do círculo
        $imagePath = storage_path('app/public/' . $badge->foto);
        if (file_exists($imagePath)) {
            $this->fpdf->Image($imagePath, $x + 15, $y + 31, 26, 26);
        }

        // adicionar imagem de fundo do crachá por cima
        $backgroundPath = public_path('images/crachá.png'); 
        if (file_exists($backgroundPath)) {
            $this->fpdf->Image($backgroundPath, $x, $y, 55, 85);
        }

        // nome 
        $this->fpdf->SetXY($x + 5, $y + 57);
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(45, 8, utf8_decode($badge->nome), 0, 1, 'C');

        // cargo e setor
        $this->fpdf->SetFont('Arial', '', 10);
    
        $this->fpdf->SetXY($x + 5, $y + 63); // posição
        $this->fpdf->Cell(45, 8, utf8_decode($badge->funcao), 0, 1, 'C');

        $this->fpdf->SetXY($x + 5, $y + 68);
        $this->fpdf->Cell(45, 8, utf8_decode($badge->setor), 0, 1, 'C');

        // matrícula
        $this->fpdf->SetXY($x + 5, $y + 73);
        $this->fpdf->Cell(45, 8, utf8_decode("Matrícula: " . $badge->matricula), 0, 1, 'C');
    }

    // exportar o PDF
    $this->fpdf->Output('D', 'crachas.pdf');
    exit;
}


}

