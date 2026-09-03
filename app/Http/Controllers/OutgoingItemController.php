<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OutgoingItem;
use Illuminate\Http\Request;

class OutgoingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $outgoingItems = OutgoingItem::with('product')

            ->when($search, function($query) use ($search){

                $query->whereHas('product', function($q) use ($search){

                    $q->where('name', 'LIKE', "%$search%");
                });

            })

            ->orderBy('date', 'desc')
            ->get();

        return view('outgoing-items.index', compact('outgoingItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('outgoing-items.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if($request->quantity > $product->stock){

            return back()->with('error', 'Stok tidak mencukupi!');
        }

        OutgoingItem::create($request->all());

        $product->stock -= $request->quantity;

        $product->save();

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(OutgoingItem $outgoingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OutgoingItem $outgoingItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OutgoingItem $outgoingItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutgoingItem $outgoingItem)
    {
        //
    }
}
