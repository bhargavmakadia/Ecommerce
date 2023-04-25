<h2>Product Details</h2>
<hr/>
<h3>{{$productarray->product_name}}</h3>
<img src="{{url('uploads/'.$productarray->product_image)}}" width="50"><br/>
Rs. {{$productarray->product_price}}<br/>
{{$productarray->product_detail}}<br/>

<form method="post" action="{{url('add-cart-process',$productarray->id)}}">
    @csrf
    <input type="hidden" name='pid' value='{{$productarray->id}}' min='1' max='10'/>
    <input type="number" name='qty' value='1' min='1' max='10'/>
    <input type="submit"/>

