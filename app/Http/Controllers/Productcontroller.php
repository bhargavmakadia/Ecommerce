<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use Illuminate\Contracts\Cache\Store;

class Productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::all();
        return view('product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('product_image');
        $original_filename = $image->getClientOriginalName();
        Storage::disk('public')->put($original_filename,File::get($image));
        
        $pq = new Product([
            'product_name' => $request->get('product_name'),
            'product_detail' => $request->get('product_detail'),
            'product_qty' => $request->get('product_qty'),
            'product_image' => $original_filename,
            'product_price' => $request->get('product_price'),
            
        ]);
        $pq->save();
        return redirect('product')->with('Success','Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pdata = Product::where('id',$id)->first();
        return view('product.show',compact('pdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productarray = Product::where('id',$id)->first();
        return view ('product.edit',compact('productarray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = $request->file('product_image');
        $original_filename = $image->getClientOriginalName();
        Storage::disk('public')->put($original_filename,File::get($image));
        
        $productarray = Product::where('id',$id)->first();        
        $productarray->product_name = $request->get('product_name');
        $productarray->product_detail = $request->get('product_detail');
        $productarray->product_qty = $request->get('product_qty');
        $productarray->product_image = $original_filename;
        $productarray->product_price = $request->get('product_price');
        
        $productarray->save();
        return redirect('/product')->with('Success','Product has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/product')->with('Success','Product has been deleted Successfully');
    }
}
