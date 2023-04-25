<h2>Product Listing</h2>
<hr/>
@foreach($productarray as $product)

<h3>{{$product->product_name}}</h3>
<img src="{{url('uploads/'.$product->product_image)}}" width="50"><br/>
Rs. {{$product->product_price}}<br/>
<a href="{{url('productdetails',$product->id)}}">Detail</a><br/>
@endforeach

