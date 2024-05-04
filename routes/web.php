<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ToppingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::controller(PizzaController::class)->group(function () {
//     Route::get('/', 'unlogged'); // This will call the index method on PizzaController
// });

Route::get('/', function (PizzaController $pizzaController, ToppingController $toppingController) {
    $pizzas = $pizzaController->indexCollection();
    $toppings = $toppingController->index();

    return view('welcome', [
        'pizzas' => $pizzas,
        'toppings' => $toppings
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('pizzas', PizzaController::class)
    ->only(['store'])
    ->middleware(['auth', 'verified']); 

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pizzas', PizzaController::class)
        ->only(['store']); // Only include store if it's the only standard method you need

    Route::get('pizzas/collection', [PizzaController::class, 'indexCollection'])
        ->name('pizzas.indexCollection');

    Route::get('pizzas/view', [PizzaController::class, 'indexView'])
        ->name('pizzas.indexView');
});

require __DIR__.'/auth.php';
