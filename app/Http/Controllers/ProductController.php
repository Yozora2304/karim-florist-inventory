<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $products = Product::where('name', 'LIKE', "%$search%")
                ->orWhere('code', 'LIKE', "%$search%")
                ->simplePaginate(10);
        } else {
            $products = Product::simplePaginate(10);
        }

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    private function generateProductCode($name)
    {
        $name = strtoupper($name);

        $prefixes = [
            'LILY' => 'LIL',
            'LILY PUTIH' => 'LIL',
            'MAWAR' => 'MWR',
            'MAWAR MERAH' => 'MWR',
            'MAWAR PUTIH' => 'MWR',
            'TULIP' => 'TLP',
            'TULIP PINK' => 'TLP',
            'MATAHARI' => 'MTH',
            'SUNFLOWER' => 'MTH',
            'ANGGREK' => 'AGR',
            'MELATI' => 'MLT',
            'ANYELIR' => 'ANY',
            'BABY BREATH' => 'BBR',
            'GERBERA' => 'GRB',
            'PEONY' => 'PNY',
            'HYDRANGEA' => 'HYD',
            'SAKURA' => 'SKR',
            'RAFFLESIA' => 'RFL',
        ];

        $prefix = null;

        foreach ($prefixes as $keyword => $codePrefix) {
            if (str_contains($name, $keyword)) {
                $prefix = $codePrefix;
                break;
            }
        }

        if (!$prefix) {
            $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $name), 0, 3));
        }

        if (strlen($prefix) < 3) {
            $prefix = str_pad($prefix, 3, 'X');
        }

        $lastProduct = Product::where('code', 'LIKE', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastProduct) {
            $lastNumber = (int) substr($lastProduct->code, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $existingProduct = Product::where('name', $request->name)
            ->where('type', $request->type)
            ->first();

        if ($existingProduct) {
            return back()->with('error', 'Produk ini sudah ada di dalam daftar.');
        }

        $code = $this->generateProductCode($request->name);

        Product::create([
            'code' => $code,
            'name' => $request->name,
            'type' => $request->type,
            'stock' => $request->stock,
            'price' => 0,
            'status' => $request->status,
        ]);

        return redirect('/products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'type' => $request->type,
            'stock' => $request->stock,
            'price' => $request->price ?? 0,
            'status' => $request->status,
        ]);

        return redirect('/products');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products');
    }
}