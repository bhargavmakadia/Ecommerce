@if(session()->get('success'))
{{session()->get('success')}}
@endif
<h1>Product Cart</h1>
<table border="1">

    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>SubTotal</th>

        <th>Action</th>
    </tr>
    <?php $total = 0;
    $i = 1; ?>
    @foreach($cartarray as $cart)
    <tr>
        <td><?php echo $i++; ?></td>
        <td>{{$cart->product_id}}</td>
        <td>{{$cart->product_qty}}</td>
        <td>{{$cart->product_price}}</td>
        <td>{{$cart->product_qty * $cart->product_price}}</td>
        <?php $total += $cart->product_qty * $cart->product_price ?>
        <td><a href="{{url('/remove-cart',$cart->id)}}">Delete</a></td>
    </tr>
    @endforeach
    <tr>
        <td><a href="{{url('/shop')}}">Continue Shopping</a></td>
        <td colspan="3">Total</td>
        <td><strong>{{$total}}</strong></td>
        <td>


        </td>
    </tr>
    <tr>
        <td>
            Shipping
        </td>
        <td colspan="3">
            <form method="post" action="{{url('placeorder')}}">
                @csrf
                Name : <input type="text" name="txt1" />
                Mobile : <input type="text" name="txt2" />
                Address : <input type="text" name="txt3" />

        <td><input type="submit" value="PlaceOrder"></td>
        </form>
        </td>
    </tr>
</table>