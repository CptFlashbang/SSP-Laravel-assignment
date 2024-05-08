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
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect('login')->with('error', 'You need to login to see this page.');
        }

        // Retrieve all orders for the logged-in user
        $orders = Auth::user()->orders;

        // Return the orders to the view (assuming you are using a view to display them)
        return view('orders.index', ['orders' => $orders]);
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
            $order->delivery = false;  // Explicitly set the default value
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
        $totalPrice = 0; // Initialize the total price
        $isDelivery = false; // Initialize delivery status

        if ($order) {
            // Assuming $order is an instance of Order, or similar
            foreach ($order->orderItems as $item) {
                $items->push([
                    'size' => $item->size,
                    'name' => $item->pizza->name, // Access the associated Pizza
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
                // Calculate total price by multiplying the price by quantity and summing it up
                $totalPrice += $item->price * $item->quantity;
            }

            // Check if the order is for delivery
            $isDelivery = $order->delivery;
            if ($isDelivery) {
                $totalPrice += 5; // Adding a fixed £5 delivery charge
            }
        }

        // Pass items, total price, and delivery status to the view
        return view('orders.index', [
            'pizzas' => $items,
            'totalPrice' => $totalPrice,
            'isDelivery' => $isDelivery // Pass the delivery status to the view
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

    public function updateDeliveryOption(Request $request)
    {
        $order = session('order');
        if (!$order) {
            return back()->withErrors('No order found in session.');
        }

        $deliveryType = $request->input('delivery_type');
        $order->delivery = ($deliveryType === 'delivery');

        // Save any changes back to the session
        session(['order' => $order]);

        return back()->with('success', 'Delivery option updated.');
    }
}
