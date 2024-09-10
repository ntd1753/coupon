<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>
<body>
<h1>Đăng ký tài khoản</h1>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Xác nhận mật khẩu:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <button type="submit">Đăng ký</button>
</form>
</body>
</html>
