<?php

namespace App\Http\Controllers;

use App\Models\Chocolate;
use Illuminate\Http\Request;

class ChocolateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            'brand' =>'string|required|max:255',
            'chocolate_name' => 'string|required|max:255',
            'price' =>'integer|required|max:6767',
            'expiry_date' =>'date|required'
        ]);

        $data = Chocolate::create($request->all());

        return response()->json(
            ["uzenet" => "Csokoládé a rendszerben"],
             201, options:JSON_UNESCAPED_UNICODE);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
