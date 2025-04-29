<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'client_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'beneficiary_name' => 'required|string|max:255',
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048',
        ]);




        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $path = $document->store('documents', 'public');
                    $documentPaths[] = [
                        'path' => $path,
                        'name' => $document->getClientOriginalName(),
                    ];
            }
        }


        Order::create([
            'client_name' => $request->client_name,
            'account_number' => $request->account_number,
            'amount' => $request->amount,
            'beneficiary_name' => $request->beneficiary_name,
            'documents' => json_encode($documentPaths),
        ]);

        return redirect()->route('orders.index');
    }


    public function validateOrder($order)
    {
        $order = Order::findOrFail($order);


        if ($order->status == 'pending') {
            $order->status = 'confirmed';
            $order->save();
        }

        return redirect()->route('orders.index')->with('success', 'L\'ordre de paiement a été validé avec succès.');
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



}
