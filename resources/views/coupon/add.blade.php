<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coupon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<h1 class="text-3xl font-bold mb-6 text-center">Add Coupon</h1>
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <form action="{{route('coupon.add')}}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="code" class="block font-medium text-gray-700">Mã Giảm giá:</label>
            <input type="text" id="code" name="code" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="discount_type" class="block font-medium text-gray-700">Loại giảm giá:</label>
            <select id="discount_type" name="discount_type" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="percentage">Giảm phần trăm</option>
                <option value="fixed">Giảm giá tiền</option>
            </select>
        </div>

        <div>
            <label for="discount_amount" class="block font-medium text-gray-700">Phần trăm giảm giá/Số tiền giảm giá:</label>
            <input type="number" id="discount_amount" name="discount_amount" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Description:</label>
            <textarea id="description" name="description" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
        </div>

        <div class="text-2xl font-bold mb-6 text-center">Điều kiện giảm giá</div>
        <div>
            <label for="coupons" class="block font-medium text-gray-700">Phạm vi áp dụng:</label>
            <div class="relative">
                <select id="scope" name="scope_model_type"
                        class="block w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="all">Tất cả sản phẩm</option>
                    <option value="category">Áp dụng theo danh mục</option>
                    <option value="product">Áp dụng theo sản phẩm</option>
                    <option value="campaigner">Áp dụng theo chiến dịch</option>
                </select>
            </div>
        </div>
        <!-- Additional select for categories (initially hidden) -->
        <div id="category-select-container" style="display: none;" class="mt-3">
            <label for="category">Chọn danh mục:</label>
            <select id="category" name="model_id"
                    class="block w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="1">Danh mục 1</option>
                <option value="2">Danh mục 2</option>
                <option value="3">Danh mục 3</option>
            </select>
        </div>
        <div id="campaign-select-container" style="display: none;" class="mt-3">
            <label for="campaign">Chọn chiến dịch:</label>
            <select id="campaign" name="model_id"
                    class="block w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="1">Chiến dịch 1</option>
                <option value="2">Chiến dịch 2</option>
                <option value="3">Chiến dịch 3</option>
            </select>
        </div>
        <div>
            <label for="minimum_purchases" class="block font-medium text-gray-700">Số đơn hàng tối thiểu đã mua:</label>
            <input type="number" id="minimum_purchases" name="minimum_purchases" value="0" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="maximum_purchases" class="block font-medium text-gray-700">Số đơn hàng tối đa đã mua:</label>
            <input type="number" id="maximum_purchases" name="maximum_purchases" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="minimum_price" class="block font-medium text-gray-700">Trị giá đơn hàng tối thiểu:</label>
            <input type="number" step="0.01" id="minimum_price" name="minimum_price" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="maximum_spend_discount" class="block font-medium text-gray-700">Giảm giá tối đa (optional):</label>
            <input type="number" id="maximum_spend_discount" name="maximum_spend_discount" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="start_date" class="block font-medium text-gray-700">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="end_date" class="block font-medium text-gray-700">End Date:</label>
            <input type="date" id="end_date" name="end_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="use_limit" class="block font-medium text-gray-700">Số lượt sử dụng (optional):</label>
            <input type="number" id="use_limit" name="use_limit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="use_limit_per_user" class="block font-medium text-gray-700">Số lượt sử dụng cho mỗi khách hàng (optional):</label>
            <input type="number" id="use_limit_per_user" name="use_limit_per_user" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="multiple_use" class="block font-medium text-gray-700">Dùng cùng với các voucher khác:</label>
            <select id="multiple_use" name="multiple_use" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="no" selected>No</option>
                <option value="yes">Yes</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add Coupon</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('scope').addEventListener('change', function() {
        var categorySelectContainer = document.getElementById('category-select-container');
        var campaignSelectContainer = document.getElementById('campaign-select-container');

        if (this.value == 'category') {
            // Show category select when "Áp dụng theo danh mục" is selected
            categorySelectContainer.style.display = 'block';
        } else {
            // Hide category select for other options
            categorySelectContainer.style.display = 'none';
        }
        if (this.value == 'campainer') {
            // Show category select when "Áp dụng theo danh mục" is selected
            campaignSelectContainer.style.display = 'block';
        } else {
            // Hide category select for other options
            campaignSelectContainer.style.display = 'none';
        }
    });

</script>
</body>
</html>
