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
    $pizzas = $pizzaController->index();
    $toppings = $toppingController->index();

    return view('welcome', [
        'pizzas' => $pizzas,
        'toppings' => $toppings
    ]);
});

Route::get('/dashboard', function (PizzaController $pizzaController, ToppingController $toppingController) {
    $pizzas = $pizzaController->index();
    $toppings = $toppingController->index();

    return view('dashboard', [
        'pizzas' => $pizzas,
        'toppings' => $toppings
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('pizzas', PizzaController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']); 

require __DIR__.'/auth.php';
