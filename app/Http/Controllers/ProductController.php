<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Rules\PasswordInt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5);
        $data = ["products" => $products];

        return view('products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        $data = ['users' => $users];
        return view('products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'quantity' => ['required', 'integer'],
            'price' => 'required',
            'description' => 'required',
            "user_id" => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }

        Product::create([
            "title" => $request->get('title'),
            "quantity" => $request->get("quantity"),
            "price" => $request->get("price"),
            "description" => $request->get("description"),
            "user_id" => $request->get("user_id"),
            "slug" => Str::slug($request->get('title')),
            "publish" => true
        ]);

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::where("id", "=", $id)->first();
        $data = ['product' => $product];

        return view('products.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::FindOrFail($id);
        $users = User::all();
        $data = ['product' => $product, 'users' => $users];

        return view('products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'quantity' => ['required', 'integer'],
            'price' => 'required',
            'description' => 'required',
            "user_id" => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)
                ->withErrors($validator)
                ->withInput();
        }

        $product->fill($request->all())->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::FindOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
