<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Add Products to Cart</h1>

    <!-- Form Add Multiple Products -->
    <form action="{{ route('cart.add') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div id="product-items">
            <div class="product-item mb-4">
                <label for="product_id" class="block text-gray-700 font-semibold">Product:</label>
                <select id="product_id" name="products[0][product_id]" class="w-full p-2 border border-gray-300 rounded-lg mt-1">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}-danh mục: {{$product->category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" onclick="addProductItem()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Add Another Product</button><br><br>

        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 focus:outline-none">Add to Cart</button>
    </form>
</div>

<script>
    let productCount = 1;

    function addProductItem() {
        const productItemsDiv = document.getElementById('product-items');
        const newItem = document.createElement('div');
        newItem.classList.add('product-item', 'mb-4');
        newItem.innerHTML = `
                <label for="product_id" class="block text-gray-700 font-semibold">Product:</label>
                <select id="product_id" name="products[${productCount}][product_id]" class="w-full p-2 border border-gray-300 rounded-lg mt-1">
                    @foreach($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }} - danh mục: {{$product->category->name}}</option>
                    @endforeach
        </select>
`;
        productItemsDiv.appendChild(newItem);
        productCount++;
    }
</script>
</body>
</html>
