<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #222;
            color: white;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            transition: 0.3s ease-in-out;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: block;
            transition: 0.3s ease-in-out;
            text-align: center;
        }

        .sidebar a:hover {
            background: #444;
            transform: scale(1.05);
        }

        /* Main Content */
        .main-content {
            margin-left: 270px;
            padding: 20px;
            flex-grow: 1;
            text-align: center;
            width: 100%;
        }

        h1 {
            color: #333;
        }

        /* Product Table */
        table {
            width: 90%;
            max-width: 1000px;
            margin: auto;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: uppercase;
            font-size: 14px;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        /* Buttons */
        .btn-edit, .btn-delete {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: 0.3s;
            padding: 7px 12px;
            border-radius: 5px;
            display: inline-block;
        }

        .btn-edit {
            background: #007bff;
        }

        .btn-edit:hover {
            background: #0056b3;
        }

        .btn-delete {
            background: red;
        }

        .btn-delete:hover {
            background: darkred;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 220px;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 150px;
                text-align: center;
            }

            .main-content {
                margin-left: 170px;
            }
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="/">🏠 Home</a>
        <a href="{{ route('product.index') }}">📦 View Products</a>
        <a href="{{ route('product.create') }}">➕ Add Product</a>
        @if($products->count() > 0)
            <a href="{{ route('product.edit', ['product' => $products->first()->id]) }}">📝 Update Product</a>
        @else
            <a href="#" onclick="alert('No products available to edit'); return false;">📝 Update Product</a>
        @endif
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Product List</h1>

        <!-- Success Message -->
        @if(session()->has('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="product-image">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->description ?? 'No Description Available' }}</td>
                        <td>
                            <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn-edit">✏ Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('product.destroy', ['product' => $product->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>


