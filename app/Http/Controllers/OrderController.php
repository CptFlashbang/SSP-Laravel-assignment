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
        $order = session('order');
        if (!$order) {
            $order = new Order();
            // Assuming a user is logged in for simplicity
            $order->user_id = auth()->id();
            $order->save();
        }

        // Add pizza to the order
        $pizza = Pizza::findOrFail($pizzaId);
        $size = $request->input('size', 'small');
        $price = $request->input('price', $pizza->SmallPrice);

        $order->addOrUpdatePizza($order, $pizza, $size, $price);

        // Save the updated order back into the session
        session(['order' => $order]);

        return back()->with('success', 'Pizza added to order!');
    }




    public function viewSessionOrder(): View
    {
        $order = session('order'); // Retrieve the order from the session
        $items = collect([]);

        if ($order) {
            // Assuming $order is an instance of Order, or similar
            // You would adapt this part based on how you've structured Order items in the session
            foreach ($order->orderItems as $item) {
                $items->push([
                    'size' => $item->size,
                    'name' => $item->pizza->name, // Access the associated Pizza
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }
        }

        return view('orders.index', [
            'pizzas' => $items
        ]);
    }

    public function clearSession(Request $request): RedirectResponse
    {
        $request->session()->flush();
        return redirect('/')->with('message', 'All session data cleared.');
    }
}
