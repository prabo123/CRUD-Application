<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        /* General Page Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        /* Success Message */
        .success-message {
            color: green;
            font-weight: bold;
            padding: 12px;
            border: 1px solid green;
            background: rgba(144, 238, 144, 0.2);
            border-radius: 8px;
            margin: 10px auto;
            width: fit-content;
        }

        /* Create Product Button */
        .button-container {
            margin-bottom: 15px;
        }

        .btn-create {
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            font-size: 16px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-create:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #4a6ed4 0%, #7b58c2 100%);
        }

        /* Product Table */
        table {
            width: 100%;
            max-width: 900px;
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

        tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        /* Buttons */
        .btn-edit {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-edit:hover {
            text-decoration: underline;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background-color: darkred;
            transform: scale(1.05);
        }

        /* Mobile Responsive */
        @media (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

    </style>
</head>
<body>

    <h1>Product List</h1>

    <!-- Display Success Message -->
    @if(session()->has('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Product Button -->
    <div class="button-container">
        <a href="{{ route('product.create') }}" class="btn-create">➕ Create a Product</a>
    </div>

    <!-- Product Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
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
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
