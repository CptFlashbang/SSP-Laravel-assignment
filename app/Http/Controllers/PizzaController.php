<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        $pizzas = Pizza::with('toppings')->latest()->get();
        return $pizzas;
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
    public function show(Pizza $pizza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pizza $pizza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pizza $pizza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pizza $pizza)
    {
        //
    }

    
}
