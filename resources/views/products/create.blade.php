<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Product</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container Box */
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        /* Title */
        h1 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-top: 10px;
            text-align: left;
            font-size: 14px;
            color: #444;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            background: rgba(255, 255, 255, 0.9);
            outline: none;
            transform: scale(1.02);
        }

        /* Submit Button */
        input[type="submit"] {
            margin-top: 20px;
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #4a6ed4 0%, #7b58c2 100%);
        }

        /* Error Messages */
        .error-messages {
            color: red;
            background: rgba(255, 102, 102, 0.2);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: left;
            width: 100%;
        }

        /* Back Link */
        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s ease-in-out;
        }

        .back-link:hover {
            text-decoration: underline;
            transform: scale(1.05);
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Create a Product</h1>

        <!-- Display Validation Errors -->
        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('product.store') }}">
            @csrf

            <label>Name</label>
            <input type="text" name="name" placeholder="Enter product name" required/>

            <label>Quantity</label>
            <input type="number" name="qty" placeholder="Enter quantity" required/>

            <label>Price</label>
            <input type="number" step="0.01" name="price" placeholder="Enter price" required/>

            <label>Description</label>
            <textarea name="description" placeholder="Enter product description" rows="3"></textarea>

            <input type="submit" value="Save Product" />
        </form>

        <a href="{{ route('product.index') }}" class="back-link">⬅ Back to Products</a>
    </div>

</body>
</html>
