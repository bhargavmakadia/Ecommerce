@if(session()->get('success'))
{{session()->get('success')}}
@endif
<table border="1">
    <thead>
        <tr>
            <th>Product</th>
            <th>Detail</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0 ?>
        @if(session('cart'))
        @foreach(session('cart') as $id=>$details)
        <?php $total += $details['price'] * $details['quantity'] ?>
        <tr>
            <td><h4>{{$details['name']}}</h4></td>
            <td>{{$details['detail']}}</td>
            <td><img src="{{url('uploads/'.$details['image'])}}" width="50"></td>
            <td>{{$details['price']}}</td>
            <td>
                <form method='post' action="{{url('update-cart',$id)}}">
                    @csrf
                <input type="number" value="{{$details['quantity']}}" name="qty" min="1" max="10"/>
                <input type="submit" value="update">
                </form>
            </td>
            <td>{{$details['price'] * $details['quantity']}}</td>
            <td><a href="{{url('/remove-cart')}}/{{$id}}">Delete</a></td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td><a href="{{url('/shop')}}">Continue Shopping</a></td>
            <td colspan="2">Total</td>
            <td><strong>{{$total}}</strong></td>
            <td></td>
            <form method="post" action="{{url('placeorder')}}">
                @csrf
                <td><input type="submit" value="PlaceOrder"></td>
    </tfoot>
</table>
