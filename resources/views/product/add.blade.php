<!-- resources/views/products/add.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
<h1>Add New Product</h1>

<!-- Hiển thị thông báo lỗi -->
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form để thêm sản phẩm -->
<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <label for="name">Product Name:</label><br>
    <input type="text" id="name" name="name" value="{{ old('name') }}"><br><br>


    <label for="category_id">Category:</label><br>
    <select id="category_id" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select><br><br>
    <label for="price">Price:</label><br>
    <input type="text" id="price" name="price" value="{{ old('price') }}"><br><br>

    <button type="submit">Add Product</button>
</form>
</body>
</html>
