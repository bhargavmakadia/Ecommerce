<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;

use App\Models\OrderMaster;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Session;



class UserSideController extends Controller
{
    public function ProductListing()
    {
        $productarray = Product::all();
        return view('user.shop',compact('productarray'));
    }

    public function ProductDetails($id)
    {
        $productarray = Product::where('id', $id)->first();
        if(!$productarray)
        {
            abort(404);
        }
        return view('user.details',compact('productarray'));
    }
    public function AddtoCartProcess(Request $request,$id)
    {
        $product_id = $id; // ID From URL
        $product_qty = $request->get('qty'); // Qty From Form
        //Fetch Price From Table
        $product = Product::find($product_id);
        $price = $product->product_price;
        //Query
        $cartq = new Cart([
            'product_id' => $product_id,
            'product_qty' => $product_qty,
            'product_price' => $price,
            'user_id' => 1,
        ]);
        //Auth::id();
        $cartq->save();
       //echo "aayo";
     return redirect('cart')->with('Success','Product Added Successfully');
    }

    public function CartListing()
    {
        $cartarray = Cart::where('user_id','=',1);//Auth::id();
        return view('user.cart',compact('cartarray'));
    }


    public function AddtoCartProcess_Session(Request $request,$id)
    {
        $product_id = $id;
        $product_qty = $request->get('qty');
        //Fetch Product Data By ID
        $product = Product::find($product_id);
        //Product Not Found Return 404
        if(!$product){
            abort(404);
        }
        //Get Session Value
        $cart = session()->get('cart');
        
        //If Cart is not Present Create First Array Value
        if(!$cart)
        {
            $cart = [
                $id => [
                    "name" => $product->product_name,
                    "detail"=>$product->product_detail,
                    "quantity" => $product_qty,
                    "image" =>$product->product_image,
                    "price" => $product->product_price
                     ]
                ];
                //Put Array in Session Cart
                session()->put('cart',$cart);
                //Redirect To Cart With Flash Data
                return redirect('/cart')->with('success','Product has been Added To Cart');
        }
        //If Product Exists Then Increment Qty with Previous + New Qty
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $product_qty;
            session()->put('cart',$cart);
            return redirect('/cart')->with('Success','Product Qty has been Updated in Cart');
        }
        //If Item not exist in cart then add to cart with new array value
        $cart[$id] = [
                "name" => $product->product_name,
                "detail"=>$product->product_detail,
                "quantity" => $product_qty,
                "image" => $product->product_image ,
                "price" => $product->product_price
            ];
            //Push Array in Cart Session
            session()->put('cart',$cart);
            //Redirect To Cart
            return redirect('/cart')->with('success','Product has been added to Cart');
    }

    

    public function CartListing_session()
    {
        $cartarray = Cart::where('user_id', '=', '1')->get(); //Auth::id();
        return view('user.cart',compact('cartarray'));
    }
    public function RemoveCart($id)
    {
    //   if($id){
    //     $cart = session()->get('cart');
    //     if(isset($cart[$id])){
    //         unset($cart[$id]);
    //         session()->put('cart',$cart);
    //     }
        Cart::find($id)->delete();
        return redirect('/cart')->with('Success','Product has been Removed From Cart');
      }
    
    public function UpdateCart(Request $request,$id)
    {
        $id = $id;
        $qty = $request->qty;
        if($id and $qty)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $qty;
            session()->put('cart',$cart);
            return redirect('/cart')->with('success','Cart Updated Successfully');
        }
    }
    public function PlaceOrder(Request $request)
    {
        $name = $request->get('txt1');
        $mobile = $request->get('txt2');
        $address = $request->get('txt3');

        $order_date = date("d-m-Y");
        $order_status = "Pending";
        $userid = "1";
        //Order Master Entry
        $ordermasterq = new OrderMaster([
            'order_date' => $order_date,
            'order_status' => $order_status,
            'userid' => $userid
        ]);
        $ordermasterq->save();

        //Get Last Record Insert ID
        $order_id = $ordermasterq->id;
        //Fetch Product Details and Store in Order Details
    
        $cartarray = Cart::where('user_id', '=', '1')->get(); //Auth::id();
        //dd($cartarray);
        //Fetch Cart Details and Add into Order Details
        foreach($cartarray as  $cartdetails)
        {
            $orderdetailsq = new OrderDetails([
                'order_id' => $order_id,
                'product_id' => $cartdetails['product_id'],
                'product_qty' => $cartdetails['product_qty'],
                'product_price' => $cartdetails['product_price']
            ]);
            $orderdetailsq->save(); 
        }
        //Remove Cart Data
        Cart::where('user_id',1)->delete(); //Auth::id();
        
        //Redirect
        return redirect('thankyou')->with('success','cart updated successfully');
    }
    public function thankyou()
    {
        return view('user.thankyou');
    }

}
