<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index() {
        return Order::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'customer_name' => 'required',
            'item_name' => 'required',
            'price' => 'required|numeric',
            'status' => 'in:pending,paid,cancelled'
        ]);
        $order = Order::create($validated);
        return response()->json($order,201);
    } 

    public function update(Request $request, $id) {
        $order = Order::findOrFail($id);
        $validated = $request->validate([
            'status' => 'in:pending,paid,cancelled'
        ]);
        $order->update(['status' => $validated['status']]);
        return response()->json($order);
    }
}
