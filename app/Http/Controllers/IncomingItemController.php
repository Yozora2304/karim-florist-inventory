<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\IncomingItem;

class IncomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $incomingItems = IncomingItem::with('product')

            ->when($search, function($query) use ($search){

                $query->whereHas('product', function($q) use ($search){

                    $q->where('name', 'LIKE', "%$search%");
                });

            })

            ->orderBy('date', 'desc')
            ->get();

        return view('incoming-items.index', compact('incomingItems'));
    }

    public function create()
    {
        $products = Product::all();

        return view('incoming-items.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        IncomingItem::create($request->all());

        $product = Product::find($request->product_id);

        $product->stock += $request->quantity;

        $product->save();

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingItem $incomingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomingItem $incomingItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomingItem $incomingItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingItem $incomingItem)
    {
        //
    }
}
