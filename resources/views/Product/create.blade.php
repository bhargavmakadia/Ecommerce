<h1>Product Create</h1>
<form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="product_name" placeholder="Name"/></td>
        </tr>
        <tr>
            <td>Detail</td>
            <td><input type="text" name="product_detail" placeholder="Detail"/></td>
        </tr>
        <tr>
            <td>Qty</td>
            <td><input type="number" name="product_qty" placeholder="Qty"/></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="product_image"/></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" name="product_price" placeholder="Price"/></td>
        </tr>
        <tr>
            <td>
    <input type="submit"/>
            </td>
        </tr>
    </table>
</form>