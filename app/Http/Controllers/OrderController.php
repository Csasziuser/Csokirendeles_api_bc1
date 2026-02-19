<?php

namespace App\Http\Controllers;

use App\Models\Chocolate;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data" => Order::with('chocolate')->get()
        ], options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'address' => 'string|required|max:255',
            'chocolate_id' => 'exists:chocolates,id|required|integer',
            'count' => "integer|required|min:1|max:40"
        ],
        [
            "required" => ":attribute mező kitöltése kötelező",
            "email" => "Az email mező email típusú",
            "string" => ":attribute mező szöveg típusú",
            "address.max" => ":attribute mező maximum :max hosszú lehet",
            "count.max" => ":attribute mező maximum :max értékű lehet",
            "exists" => ":attribute nem létezik",
            "integer" => ":attribute mező szám típusú"
        ],
        [
            "address" => "szállítási cím",
            "chocolate_id" => "csoki",
            "count" => "mennyiség"
        ]
    );


        $chocolate = Chocolate::find($request->chocolate_id);
        $osszeg = $chocolate->price * $request->count;

        $data = Order::create([
            "email" => $request->email,
            "address" => $request->address,
            "chocolate_id" => $request->chocolate_id,
            "count" => $request->count,
            "all_price" => $osszeg
        ]);

        return response()->json(["uzenet" => "Sikeres rendelés!"],
        201, 
        options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            "count" => "integer|required|min:1|max:40"
        ]);

        $order = Order::find($id);
        $order->count = $request->count;

        $chocolate_price = Chocolate::find($order->chocolate_id)->price;
        $order->all_price = $chocolate_price * $order->count;

        $order->save();

        return response() -> json([
            "uzenet" => "Rendelés mennyisége frissítve!"
        ], 200, options: JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        $order->delete();

        return response()->json(["uzenet" => "Rendelés törölve"], 200, options:JSON_UNESCAPED_UNICODE);
    }
}
