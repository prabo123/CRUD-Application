<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Product</title>
</head>
<body>
    <h1>Create a Product</h1>

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

    <form method="post" action="{{ route('product.store') }}">
        @csrf
        @method('POST')

        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" required/>
        </div>

        <div>
            <label>Qty</label>
            <input type="number" name="qty" placeholder="Qty" required/>
        </div>

        <div>
            <label>Price</label>
            <input type="number" step="0.01" name="price" placeholder="Price" required/>
        </div>

        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description" required/>
        </div>

        <div>
            <input type="submit" value="Save a New Product" />
        </div>
    </form>

</body>
</html>
