<h1>Product Index</h1>

<a href="{{route('product.create')}}">Add</a> |
<a href="{{route('product.index')}}">View</a> |
<a href="{{url('/shop')}}">Shop</a> |
<br/><br/>
@if(session()->get('Success'))
<span style="color: green">{{session()->get('Success')}}</span>
@endif
<table border='1'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Detail</th>
        <th>Qty</th>
        <th>Image</th>
        <th>Price</th>
        <th>Created</th>
        <th>Updated</th>
        <th colspan="5">Action</th>
    </tr>
    @foreach($product as $pdata)
    <tr>
        <td>{{$pdata->id}}</td>
        <td>{{$pdata->product_name}}</td>
        <td>{{$pdata->product_detail}}</td>
        <td>{{$pdata->product_qty}}</td>
        <td><img src='uploads/{{$pdata->product_image}}' width='70'/></td>
        <td>{{$pdata->product_price}}</td>
        <td>{{$pdata->created_at}}</td>
        <td>{{$pdata->updated_at}}</td>
        <td>
            <form action="{{route('product.show',$pdata->id)}}" method="get">
                 @csrf
                 @method('GET')
                 <button type="submit" class='button'>Show</button>
             </form>
         </td>
         <td>
             <form action="{{route('product.edit',$pdata->id)}}" method="get">
                 @csrf
                 @method('PATCH')
                 <button type="submit" class='button'>Edit</button>
             </form>
         </td>
         <td>
             <form action="{{route('product.destroy',$pdata->id)}}" method="post">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class='button'>Delete</button>
             </form>
         </td>
    </tr>
    @endforeach
</table>