<form action="{{route('category.store')}}" method="POST">
    @csrf
    <div>
        <label>tên danh mục</label>
        <input type="text" name="name" required>
    </div>
    <button>tạo</button>
</form>
