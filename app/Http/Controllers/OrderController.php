<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Pizza;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function addPizzaToSession(Request $request, $pizzaId): RedirectResponse
    {
        $pizza = Pizza::findOrFail($pizzaId);
        $order = session('order', collect([]));  // Retrieves the order from session, or initializes an empty collection

        // Check if the pizza already exists in the order
        $exists = $order->where('id', $pizzaId)->count();
        if ($exists) {
            $order = $order->map(function ($item) use ($pizzaId) {
                if ($item['id'] === $pizzaId) {
                    $item['quantity'] += 1;  // Increment quantity if pizza is already in the order
                }
                return $item;
            });
        } else {
            // If not exists, add the pizza with quantity 1
            $order->push(['id' => $pizza->id, 'name' => $pizza->name, 'price' => $request->price, 'quantity' => 1]);
        }

        session(['order' => $order]);
        return back()->with('success', 'Pizza added to order!');
    }

    public function viewSessionOrder(): View
    {
        $order = session('order', collect([]));
        return view('orders.index', [
            'pizzas' => $order
        ]);
    }
}
