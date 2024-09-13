
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
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Loyalty Settings</h2>

        <!-- Form to update loyalty settings -->
        <form action="{{ route('config.loyalty.set') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Points per Order Amount -->
            <div>
                <label for="points_per_order_amount" class="block text-sm font-medium text-gray-700">Points Per Order Amount</label>
                <input type="number" name="points_per_order_amount" id="points_per_order_amount" value="{{ config('website.points_per_order_amount') }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Points per Unit -->
            <div>
                <label for="points_per_unit" class="block text-sm font-medium text-gray-700">Points Per Unit</label>
                <input type="number" name="points_per_unit" id="points_per_unit" value="{{ config('website.points_per_unit') }}"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
