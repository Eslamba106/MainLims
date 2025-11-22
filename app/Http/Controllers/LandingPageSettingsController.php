<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingSettings;

class LandingPageSettingsController extends Controller
{
    public function list()
    {
        return view('admin.landing_page.landing-side');
    }

    public function header()
    {
        return view('admin.landing_page.header');
    }

    public function header_update(Request $request)
    {
        // Logic to store landing page settings
        return redirect()->route('admin.landing_page_settings');
    }
    public function home()
    {
        $title = LandingSettings::where('type', 'home_settings')->where('key' , 'home_title')->select('key', 'value' ,'type')->first();
        $subtitle = LandingSettings::where('type', 'home_settings')->where('key' , 'home_subtitle')->select('key', 'value' ,'type')->first();
        $image = LandingSettings::where('type', 'home_settings')->where('key' , 'home_image')->select('key', 'value' ,'type')->first();
        $data =[
            'title' => $title,
            'subtitle' => $subtitle,
            'image' => $image,
        ];
        return view('admin.landing_page.home', $data);
    }

    public function home_update(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/landing_page/home/');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $oldImage = LandingSettings::where('key', 'home_image' )->where('type' , 'home_settings')->first();
            if ($oldImage && file_exists(public_path($oldImage->value))) {
                unlink(public_path($oldImage->value));
            }
            $file->move($path, $filename);

            LandingSettings::updateOrCreate(
                ['key' => 'home_image'],
                [
                    'value' => 'uploads/landing_page/home/' . $filename,
                    'type' => 'home_settings'
                ]
            );
        }
        $title = LandingSettings::updateOrCreate(  ['key' => 'home_title'],[
            'key' => 'home_title',
            'value' => $request->title,
            'type' => 'home_settings'
        ]);
        $subtitle = LandingSettings::updateOrCreate(  ['key' => 'home_subtitle'],[
            'key' => 'home_subtitle',
            'value' => $request->subtitle,
            'type' => 'home_settings'
        ]);

        return redirect()->back()->with('success', translate('Home settings updated successfully.'));
    }
    public function feature()
    {
        $title = LandingSettings::where('type', 'feature_settings')->where('key' , 'feature_title')->select('key', 'value' ,'type')->first();
        $subtitle = LandingSettings::where('type', 'feature_settings')->where('key' , 'feature_subtitle')->select('key', 'value' ,'type')->first();
        $image = LandingSettings::where('type', 'feature_settings')->where('key' , 'feature_image')->select('key', 'value' ,'type')->first();
        $data =[
            'title' => $title,
            'subtitle' => $subtitle,
            'image' => $image,
        ];
        return view('admin.landing_page.feature', $data);
    }

    public function feature_update(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/landing_page/feature/');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $oldImage = LandingSettings::where('key', 'feature_image' )->where('type' , 'feature_settings')->first();
            if ($oldImage && file_exists(public_path($oldImage->value))) {
                unlink(public_path($oldImage->value));
            }
            $file->move($path, $filename);

            LandingSettings::updateOrCreate(
                ['key' => 'feature_image'],
                [
                    'value' => 'uploads/landing_page/feature/' . $filename,
                    'type' => 'feature_settings'
                ]
            );
        }
        $title = LandingSettings::updateOrCreate(  ['key' => 'feature_title'],[
            'key' => 'feature_title',
            'value' => $request->title,
            'type' => 'feature_settings'
        ]);
        $subtitle = LandingSettings::updateOrCreate(  ['key' => 'feature_subtitle'],[
            'key' => 'feature_subtitle',
            'value' => $request->subtitle,
            'type' => 'feature_settings'
        ]);

        return redirect()->back()->with('success', translate('Feature settings updated successfully.'));
    }
}
