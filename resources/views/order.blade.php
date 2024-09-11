<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thêm jQuery -->
</head>
<body class="bg-gray-100 text-gray-800">
<div class="container mx-auto p-4">
    <!-- Cart Items -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        @foreach($cart->cartItem as $item)
            <div class="mb-4 border-b pb-4">
                <h2 class="text-lg font-semibold">{{$item->product->name}}</h2>
                <p class="text-gray-600">Price: ${{$item->product->price}}</p>
            </div>
        @endforeach
    </div>

    <!-- Totals -->
    <div class="bg-white p-6 mt-4 rounded-lg shadow-md">
        <div class="mb-4">
            <p class="text-lg font-semibold">Total: $<span id="total-price">{{$cart->total_price}}</span></p>
        </div>
        <div>
            <p class="text-lg font-semibold">Final Total: $<span id="final-price">{{$cart->final_price}}</span></p>
        </div>
    </div>

    <!-- Coupon Form -->
    <div class="bg-white p-6 mt-4 rounded-lg shadow-md">
        <form id="apply-coupon-form">
            <label class="block text-gray-700 font-semibold mb-2">Coupon</label>
            <input class="w-full p-2 border border-gray-300 rounded-lg" name="coupon_code" id="coupon_code" type="text" placeholder="Enter coupon code">
            <button type="button" id="apply-coupon" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Apply</button>
        </form>
    </div>
</div>

<script>
    // AJAX request để apply coupon
    $('#apply-coupon').click(function() {
        var couponCode = $('#coupon_code').val(); // Lấy giá trị từ input

        $.ajax({
            url: '{{ route('cart.applyCoupon',['cartId'=>$cart->id]) }}', // Route xử lý mã giảm giá
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Laravel CSRF token
                coupon_code: couponCode
            },
            success: function(response) {
                if(response.success) {
                    // Cập nhật lại giá trị giỏ hàng (total_price và final_price)
                    $('#total-price').text(response.total_price);
                    $('#final-price').text(response.final_price);
                    alert('Coupon applied successfully!');
                } else {
                    alert(response.message); // Hiển thị lỗi nếu có
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseJSON.message); // Lấy message từ phản hồi lỗi của server
            }

        });
    });
</script>
</body>
</html>
