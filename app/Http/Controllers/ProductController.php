<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'minimum_price' => 'required|numeric',
            'start_datetime' => 'required|string',
            'end_datetime' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'minimum_price' => $request->input('minimum_price'),
            'end_datetime' => $request->input('end_datetime'),
            'start_datetime' => $request->input('start_datetime'),
            'user_id' => $request->input('user_id'),
        ]);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'minimum_price' => 'required|numeric',
            'start_datetime' => 'required|string',
            'end_datetime' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $product = Product::find($id);

        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'minimum_price' => $request->input('minimum_price'),
            'end_datetime' => $request->input('end_datetime'),
            'start_datetime' => $request->input('start_datetime'),
            'user_id' => $request->input('user_id'),
        ]);

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Proizvod nije pronađen.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Proizvod je uspešno obrisan.']);
    }
}
