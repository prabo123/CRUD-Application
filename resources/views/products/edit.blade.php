<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Product</title>
</head>
<body>
    <h1>Edit a Product</h1>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('product.update', ['product' => $product->id]) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" value="{{ $product->name }}" required/>
        </div>

        <div>
            <label>Qty</label>
            <input type="number" name="qty" placeholder="Qty" value="{{ $product->qty }}" required/>
        </div>

        <div>
            <label>Price</label>
            <input type="number" step="0.01" name="price" placeholder="Price" value="{{ $product->price }}" required/>
        </div>

        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description" value="{{ $product->description }}" required/>
        </div>

        <div>
            <input type="submit" value="Update Product" />
        </div>
    </form>

</body>
</html>
