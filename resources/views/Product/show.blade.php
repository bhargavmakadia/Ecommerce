Name : {{$pdata->product_name}}
<br/>
Detail : {{$pdata->product_detail}}
<br/>
Qty : {{$pdata->product_qty}}
<br/>
<img src="{{asset('uploads/'.$pdata->product_image)}}" width="500">
<br/>
Price : {{$pdata->product_price}}
<br/>
<a href="{{ route('product.index') }}">Back</a>

