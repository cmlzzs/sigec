<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\LoteController;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


Route::get('/index', function () {
    $badges = Badge::all();
    return view('badges.index', compact('badges'));
});

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/password', [UserController::class, 'editPassword'])->name('user.password.edit');
    Route::post('/perfil/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');
});


// Rotas de autenticação
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');



// Rota para o registro de novos usuários
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);



// Atualizar status
Route::post('/badge/{id}/registrar', function ($id) {
    $cracha = Badge::findOrFail($id);
    $cracha->status = ($cracha->status == 'Disponível') ? 'Em Uso' : 'Disponível';
    $cracha->save();
    return back()->with('success', 'Status atualizado com sucesso!');
});



Route::get('/admin', function () {
    $user = Auth::user(); 
    return view('admin.dashboard', compact('user'));
})->name('admin.dashboard');

Route::get('/users', function () {
    return view('users.dashboard');
})->name('users.dashboard');

Route::get('/auth', function () {
    return view('auth.login');
})->name('auth.login');



Route::get('/lote/{id}', [BadgeController::class, 'showBadgesByLote']);


Route::prefix('admin/lotes')->name('admin.lotes.')->group(function () {
    Route::get('/', [LoteController::class, 'index'])->name('index');
    Route::get('/create', [LoteController::class, 'create'])->name('create');
    Route::post('/', [LoteController::class, 'store'])->name('store');
    Route::get('/{lote}/edit', [LoteController::class, 'edit'])->name('edit');
    Route::put('/{lote}', [LoteController::class, 'update'])->name('update');
    Route::delete('/{lote}', [LoteController::class, 'destroy'])->name('destroy');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::delete('/badges/{badge}/cancelar', [BadgeController::class, 'cancelar'])->name('badges.cancelar');



Route::get('/funcionario', function () {
    $lotes = Lote::all();
    $badges = Badge::all();
    $user = Auth::user();

     // conta usuarios do banco
    $totalUsers = User::count();

    // conta lotes
    $finalizados = Lote::where('status', 'Finalizado')->count();
    $producao = Lote::where('status', 'Em produção')->count();
    $grafica = Lote::where('status', 'Gráfica')->count();

    return view('funcionario.index', compact('lotes', 'badges', 'user', 'totalUsers', 'finalizados', 'producao', 'grafica')); 
})->name('funcionario.index');


// passar as varias nessa rota 
Route::get('/admin', function () {
    $users = User::all();
    $user = Auth::user(); 
      // conta usuarios do banco
    $totalUsers = User::count();
    return view('admin.dashboard', compact('users', 'user', 'totalUsers')); 
})->name('admin.dashboard');

Route::get('/users', function () {
    $user = Auth::user(); 
    //$badges = Badge::all(); 
    $badges = Badge::where('user_id', auth()->id())->get();
    return view('admin.users.dashboard', compact('user', 'badges')); 
})->name('admin.users.dashboard');

Route::get('/historico', function () {
    $user = Auth::user(); 
    $badges = Badge::where('user_id', auth()->id())->get();
    return view('admin.users.historico', compact('user', 'badges')); 
})->name('admin.users.historico');


Route::get('/export', function () {
    return view('badges.badges_pdf'); 
})->name('badges.badges_pdf');

// criar um novo lote
Route::get('/admin/lote/criar', function () {
    return view('admin.lote.create'); 
})->name('admin.lote.create');

// grupo de rotas do admin
Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index'); // listar usuários
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store'); // criar 
    Route::get('/users/criar', [UserController::class, 'create'])->name('admin.users.create'); // criar 
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit'); //  edição
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show'); // ver
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update'); // atualizar 
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // deletar
   
});


Route::prefix('funcionarios')->group(function () {
   
     Route::get('/lote', [LoteController::class, 'index'])->name('funcionario.lote.index');
     // criar lote
     Route::get('/lote/criar', [LoteController::class, 'create'])->name('funcionario.lote.create'); 
     Route::post('/lote', [LoteController::class, 'store'])->name('funcionario.lote.store');
    // ver lote específico
    Route::get('/lote/{lote}', [LoteController::class, 'show'])->name('funcionario.lote.show');
     // editar lote
     Route::get('/lote/{lote}/editar', [LoteController::class, 'edit'])->name('funcionario.lote.edit');
     Route::put('/lote/{lote}', [LoteController::class, 'update'])->name('funcionario.lote.update');
     // excluir lote
     Route::delete('/lote/{lote}', [LoteController::class, 'destroy'])->name('funcionario.lote.destroy');

     Route::get('/badges', [BadgeController::class, 'index'])->name('admin.badges.index'); 
     Route::post('/badges', [BadgeController::class, 'store'])->name('admin.badges.store'); 
     Route::get('/badges/create', [BadgeController::class, 'create'])->name('admin.badges.create'); 
     Route::get('/badges/{badge}/edit', [BadgeController::class, 'edit'])->name('admin.badges.edit'); 
     Route::get('/badges/{badge}', [BadgeController::class, 'show'])->name('admin.badges.show'); 
     Route::put('/badges/{badge}', [BadgeController::class, 'update'])->name('admin.badges.update'); 
     Route::delete('/badges/{badge}', [BadgeController::class, 'destroy'])->name('admin.badges.destroy'); 
     Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show'); // ver
});

Route::prefix('admin')->group(function () {
    Route::get('/badges', [BadgeController::class, 'index'])->name('admin.badges.index'); 
    Route::post('/badges', [BadgeController::class, 'store'])->name('admin.badges.store'); 
    Route::get('/badges/create', [BadgeController::class, 'create'])->name('admin.badges.create'); 
    Route::get('/badges/{badge}/edit', [BadgeController::class, 'edit'])->name('admin.badges.edit'); 
    Route::get('/badges/{badge}', [BadgeController::class, 'show'])->name('admin.badges.show'); 
    Route::put('/badges/{badge}', [BadgeController::class, 'update'])->name('admin.badges.update'); 
    Route::delete('/badges/{badge}', [BadgeController::class, 'destroy'])->name('admin.badges.destroy'); 
});


//Route::get('/pdf', [PdfController::class, 'index']);

Route::resource('badges', BadgeController::class);
Route::get('/export-badge/{loteId}', [BadgeController::class, 'export']);
//Route::post('/exportar/crachas', [ExportController::class, 'exportCrachas'])->name('badges.export');
//Route::get('/badges/pdf', [BadgeController::class, 'pdf'])->name('badges.pdf');


///Route::get('/badges/export/{loteId}', [BadgeController::class, 'export']);

Route::post('/lote/status', [LoteController::class, 'NotificationLote']);



Route::put('/perfil/update', [UserController::class, 'updateProfile'])->name('admin.users.configs');


//Route::get('/sendMail', function () {
    ///Mail::to('carimamalemos2@gmail.com')
  //  ->send(new HelloMail());
//});



Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('forgot.password');

Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('forgot.password');


Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])->name('reset.password');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password');





