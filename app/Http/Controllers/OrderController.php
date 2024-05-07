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
            $order->user_id = auth()->id();
            $order->collection = true;  // Explicitly set the default value
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
        // Remove only the 'order' from the session
        $request->session()->forget('order');
        
        return redirect('/dashboard')->with('message', 'Order cleared from session.');
    }

    public function saveSessionOrderToDatabase(Request $request): RedirectResponse
    {
        // Retrieve the order from the session
        $order = session('order');

        // Check if there is an order in the session
        if ($order) {
            // Assuming $order is an object and needs to be re-saved or could be updated
            // You might need to adjust how this is handled based on your actual data structure

            // Save the order to the database
            $dbOrder = new Order();
            $dbOrder->user_id = $order->user_id;
            $dbOrder->save();



            // After saving, clear the order from the session
            $this->clearSession($request);
        }

        // Redirect with a success message
        return redirect('/dashboard')->with('success', 'Order has been saved and session cleared.');
    }
}
