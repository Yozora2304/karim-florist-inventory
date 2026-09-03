<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\IncomingItem;
use App\Models\OutgoingItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;
        $productId = $request->product_id;

        $products = Product::orderBy('name', 'asc')->get();

        $incomingItems = collect();
        $outgoingItems = collect();

        $totalIncoming = 0;
        $totalOutgoing = 0;
        $mostOutgoing = null;

        if ($month) {
            $monthNumber = date('m', strtotime($month));
            $yearNumber = date('Y', strtotime($month));

            $incomingQuery = IncomingItem::with('product')
                ->whereMonth('date', $monthNumber)
                ->whereYear('date', $yearNumber);

            $outgoingQuery = OutgoingItem::with('product')
                ->whereMonth('date', $monthNumber)
                ->whereYear('date', $yearNumber);

            if ($productId) {
                $incomingQuery->where('product_id', $productId);
                $outgoingQuery->where('product_id', $productId);
            }

            $incomingItems = $incomingQuery->orderBy('date', 'desc')->get();
            $outgoingItems = $outgoingQuery->orderBy('date', 'desc')->get();

            $totalIncoming = $incomingItems->sum('quantity');
            $totalOutgoing = $outgoingItems->sum('quantity');

            $mostOutgoing = $outgoingItems
                ->groupBy('product_id')
                ->map(function ($items) {
                    return [
                        'name' => $items->first()->product->name,
                        'code' => $items->first()->product->code,
                        'total' => $items->sum('quantity')
                    ];
                })
                ->sortByDesc('total')
                ->first();
        }

        return view('reports.index', compact(
            'products',
            'incomingItems',
            'outgoingItems',
            'totalIncoming',
            'totalOutgoing',
            'mostOutgoing',
            'month',
            'productId'
        ));
    }
}