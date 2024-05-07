<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ToppingController;
use App\Http\Controllers\OrderController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/menu', function (PizzaController $pizzaController, ToppingController $toppingController) {
    $pizzas = $pizzaController->index();
    $toppings = $toppingController->index();

    return view('pizzas.index', [
        'pizzas' => $pizzas,
        'toppings' => $toppings
    ]);
})->middleware(['auth', 'verified'])->name('menu');

Route::post('/add-pizza-to-session/{pizzaId}', [OrderController::class, 'addPizzaToSession'])->name('add-pizza-to-session');
Route::get('/view-session-order', [OrderController::class, 'viewSessionOrder'])->name('view-session-order');
Route::post('/save-order', [OrderController::class, 'saveSessionOrderToDatabase'])->name('order.save');
Route::post('/update-delivery', [OrderController::class, 'updateDeliveryOption'])->name('order.update-delivery');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('pizzas', PizzaController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']); 

Route::post('session/clear', [OrderController::class, 'clearSession'])
->name('session.clear')
->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
