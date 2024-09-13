<?php

namespace App\Http\Controllers;

use App\Models\LoyaltySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ConfigController extends Controller
{
    function getLoyalty(){
        $pointsPerOrderAmount = config('website.points_per_order_amount');
        $pointsPerUnit = config('website.points_per_unit');
        return view('loyalty.add',compact('pointsPerOrderAmount','pointsPerUnit'));
    }
    function settingLoyalty(Request $request){
        $validatedData = $request->validate([
            'points_per_order_amount' => 'required|integer|min:1',
            'points_per_unit' => 'required|integer|min:1',
        ]);
        $configPath = config_path('website.php');
        $config = include $configPath;
        $config['points_per_order_amount'] = $request->input('points_per_order_amount');
        $config['points_per_unit'] = $request->input('points_per_unit');
        $configString = "<?php\n\nreturn " . var_export($config, true) . ";\n";

        File::put($configPath, $configString);
        Artisan::call('config:cache');

        return redirect()->route('config.loyalty');
    }
}
