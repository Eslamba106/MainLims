<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSettings;

class LandingPageController extends Controller
{
    public function index()
    {
        $home_image = LandingSettings::where('type', 'home_settings')->where('key' , 'home_image')->select('key', 'value' ,'type')->first();
        $home_title = LandingSettings::where('type', 'home_settings')->where('key' , 'home_title')->select('key', 'value' ,'type')->first();
        $home_subtitle = LandingSettings::where('type', 'home_settings')->where('key' , 'home_subtitle')->select('key', 'value' ,'type')->first();
        $feature_image = LandingSettings::where('type', 'feature_settings')->where('key' , 'feature_image')->select('key', 'value' ,'type')->first();
        $feature_title = LandingSettings::where('type', 'feature_settings')->where('key' , 'feature_title')->select('key', 'value' ,'type')->first();
        $feature_subtitle = LandingSettings::where('type', 'feature_settings')->where('key' , 'feature_subtitle')->select('key', 'value' ,'type')->first();

        $data =[
            'home_image' => $home_image,
            'home_title' => $home_title,
            'home_subtitle' => $home_subtitle,
            'feature_image' => $feature_image,
            'feature_title' => $feature_title,
            'feature_subtitle' => $feature_subtitle,
        ];
        return view('landing' , $data);
    }
}
