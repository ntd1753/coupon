<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
<h1>Đăng nhập</h1>

<!-- Hiển thị lỗi khi có -->
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        @error('password')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Đăng nhập</button>
</form>
</body>
</html>
