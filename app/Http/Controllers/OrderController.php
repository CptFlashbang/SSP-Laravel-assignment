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
        $order = session('order', collect([]))->all();  // Convert collection to array

        // Retrieve size and price from request
        $size = $request->input('size');  // Assuming the size is sent via request
        $price = $request->input('price', $pizza->SmallPrice); // Default to SmallPrice if not provided

        // Define a unique identifier for each type and size of pizza
        $uniqueIdentifier = $pizzaId . '_' . $size;

        // Find existing pizza in the order
        $found = array_search($uniqueIdentifier, array_column($order, 'uniqueIdentifier'));

        if ($found !== false) {
            // If found, increment the quantity
            $order[$found]['quantity'] += 1;
        } else {
            // If not found, add new pizza with quantity 1
            $order[] = [
                'id' => $pizza->id,
                'uniqueIdentifier' => $uniqueIdentifier,
                'name' => $pizza->name,
                'size' => $size,
                'price' => $price,
                'quantity' => 1
            ];
        }

        // Update the session with the modified order
        session(['order' => collect($order)]);  // Convert array back to collection

        return back()->with('success', 'Pizza added to order!');
    }

    public function viewSessionOrder(): View
    {
        $order = session('order', collect([]));
        return view('orders.index', [
            'pizzas' => $order
        ]);
    }

    public function clearSession(Request $request): RedirectResponse
    {
        $request->session()->flush();
        return redirect('/')->with('message', 'All session data cleared.');
    }
}
