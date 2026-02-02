<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\BestiarioController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LegalController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user && $user->role === \App\Models\User::ROLE_ADMIN) {
        return redirect('/admin');
    }

    return redirect()->route('partidas.index');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

// Dashboard admin
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware(['auth', 'verified', 'admin']);

    // Admin campaigns
Route::prefix('admin/campaigns')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'campaigns'])->name('admin.campaigns'); // Lista campañas
    Route::get('/create', [AdminController::class, 'createCampaign'])->name('admin.campaigns.create'); // Crear campaña
    Route::delete('/{campaign}', [AdminController::class, 'destroyCampaign'])->name('admin.campaigns.destroy'); // Eliminar
});

// Admin characters
Route::prefix('admin/characters')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'characters'])->name('admin.characters'); // Lista personajes
    Route::get('/create', [AdminController::class, 'createCharacter'])->name('admin.characters.create'); // Crear personaje
    Route::post('/', [AdminController::class, 'storeCharacter'])->name('admin.characters.store'); // Guardar personaje
    Route::get('/{character}/edit', [AdminController::class, 'editCharacter'])->name('admin.characters.edit'); // Editar
    Route::delete('/{character}', [AdminController::class, 'destroyCharacter'])->name('admin.characters.destroy'); // Eliminar
});


// Usuarios (admin)
Route::prefix('admin/users')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'users'])->name('admin.users');                // Lista usuarios
    Route::get('/create', [AdminController::class, 'createUser'])->name('admin.users.create'); // Form crear usuario
    Route::post('/', [AdminController::class, 'storeUser'])->name('admin.users.store');       // Guardar usuario
    Route::delete('/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy'); // Eliminar usuario
});

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Partidas
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/partidas', [CampaignController::class, 'index'])->name('partidas.index');
    Route::get('/partidas/crear', [CampaignController::class, 'create'])->name('partidas.create');
    Route::post('/partidas', [CampaignController::class, 'store'])->name('partidas.store');
    Route::get('/partidas/{campaign}/edit', [CampaignController::class, 'edit'])->name('partidas.edit');
    Route::put('/partidas/{campaign}', [CampaignController::class, 'update'])->name('partidas.update');
    Route::delete('/partidas/{campaign}', [CampaignController::class, 'destroy'])->name('partidas.destroy');
    Route::patch('/partidas/{campaign}/finalizar', [CampaignController::class, 'finalizar'])->name('partidas.finalizar');
    Route::get('/historial', [CampaignController::class, 'historial'])->name('partidas.show');
});

// Bestiario
Route::get('/bestiario', [BestiarioController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('bestiario.index');
Route::get('/bestiario/{monster}', [BestiarioController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('bestiario.show');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

//Rutas para la API del frontend, para que el user() funcione en la API
Route::get('/me', function () {
    if (!Auth::check()) return response()->json(['authenticated' => false]);

    return response()->json([
        'authenticated' => true,
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
    ]);
});

Route::get('/me-public', function () {
    return ['authenticated' => false];
});


// Rutas footer con middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/politica-privacidad', [LegalController::class, 'politicaPrivacidad'])->name('legal.politicaPrivacidad');
    Route::view('/accesibilidad', 'legal.accesibilidad')->name('legal.accesibilidad');
    Route::get('/terminos-uso', [LegalController::class, 'terminosUso'])->name('legal.terminosUso');
    Route::get('/contacto', [LegalController::class, 'contacto'])->name('legal.contacto');
    Route::post('/contacto/enviar', [LegalController::class, 'enviarContacto'])->name('legal.contacto.enviar');
});





require __DIR__ . '/auth.php';
