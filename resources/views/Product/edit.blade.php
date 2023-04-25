<h3>Edit Product</h3>
<form method="post" action="{{route('product.update',$productarray->id)}}" enctype="multipart/form-data" >

    @csrf

    @method('PATCH')

    <table>
        <tr>
        <td>Name</td>
        <td><input type='text' name='product_name' value='{{$productarray->product_name}}'></td>
    </tr>
    <tr>
        <td>Detail</td>
        <td><input type='text' name='product_detail' value='{{$productarray->product_detail}}'></td>
    </tr>
    <tr>
        <td>Qty</td>
        <td><input type='number' name='product_qty' value='{{$productarray->product_qty}}'></td>
    </tr>
    <tr>
        <td>Image</td>
        <td><input type="file" name="product_image" value='{{$productarray->product_image}}'></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><input type='number' name='product_price' value='{{$productarray->product_price}}'></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type='submit' value="Update">
            <a href="{{URL::route('product.index')}}">Back</a>
        </td>
    </tr>
    </table>
</form>
