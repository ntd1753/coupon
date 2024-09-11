<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Coupons</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">All Coupons</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg w-full overflow-auto">
        <table class="w-full text-left table-auto">
            <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Code</th>
                <th class="px-4 py-2">Discount Type</th>
                <th class="px-4 py-2">Discount Amount</th>
                <th class="px-4 py-2">Minimum Purchases</th>
                <th class="px-4 py-2">Maximum Purchases</th>
                <th class="px-4 py-2">Minimum Price</th>
                <th class="px-4 py-2">Maximum Spend Discount</th>
                <th class="px-4 py-2">Use Limit</th>
                <th class="px-4 py-2">Use Limit per User</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Start Date</th>
                <th class="px-4 py-2">End Date</th>
                <th class="px-4 py-2">Vendor</th>
                <th class="px-4 py-2">Scopes</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coupons as $coupon)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $coupon->code }}</td>
                    <td class="px-4 py-2">{{ ucfirst($coupon->discount_type) }}</td>
                    <td class="px-4 py-2">{{ $coupon->discount_amount }}</td>
                    <td class="px-4 py-2">{{ $coupon->minimum_purchases }}</td>
                    <td class="px-4 py-2">{{ $coupon->maximum_purchases }}</td>
                    <td class="px-4 py-2">{{ $coupon->minimum_price }}</td>
                    <td class="px-4 py-2">{{ $coupon->maximum_spend_discount }}</td>
                    <td class="px-4 py-2">{{ $coupon->use_limit }}</td>
                    <td class="px-4 py-2">{{ $coupon->use_limit_per_user }}</td>
                    <td class="px-4 py-2">{{ $coupon->description }}</td>
                    <td class="px-4 py-2">{{ $coupon->start_date }}</td>
                    <td class="px-4 py-2">{{ $coupon->end_date }}</td>
                    <td class="px-4 py-2">
                        @if($coupon->vendor)
                            {{ $coupon->vendor->name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($coupon->scope->isNotEmpty())
                            @foreach($coupon->scope as $scope)
                                @if($scope->model_type == 'category')
                                    <p>{{ $scope->model_type }}: {{ $scope->category->name }}</p>
                                @elseif($scope->model_type == 'product')
                                    <p>{{ $scope->model_type }}: {{ $scope->product->name }}</p>
                                @endif
                            @endforeach
                        @else
                            Áp dụng cho tất cả sản phẩm
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
