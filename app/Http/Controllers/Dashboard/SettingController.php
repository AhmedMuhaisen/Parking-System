<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::find(1);
        $folder = 'setting';
        return view('Dashboard.setting', compact('setting', 'folder'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


       $request->validate([
        'website_name' => 'required',
        'website_email' => 'required',
        'address' => 'required',
        'website_phone' => 'required',
        'website_logo' => 'nullable|image|mimes:jpg,jpeg,png',
        'header_title' => 'required',
        'header_subtitle' => 'required',
        'header_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'header_background' => 'nullable|image|mimes:jpg,jpeg,png',
        'about_title' => 'required',
        'about_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'about_content' => 'required',
        'advantage_title' => 'required',
        'advantage_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'advantage_text' => 'required',
         'advantages' => 'required',
    ]);
        $setting = Setting::find(1);
  if ($request->website_logo) {
            $website_logo = $request->website_logo;
            $website_logo = $website_logo->storePublicly('setting', 'new');
        } else {
            $website_logo = $setting->website_logo;
        }



        if ($request->about_image) {
            $about_image = $request->about_image;
            $about_image = $about_image->storePublicly('setting', 'new');
        } else {
            $about_image = $setting->about_image;
        }

        if ($request->header_image) {
            $header_image = $request->header_image;
            $header_image = $header_image->storePublicly('setting', 'new');
        } else {
            $header_image = $setting->header_image;
        }



        if ($request->header_background) {
            $header_background = $request->header_background;
            $header_background = $header_background->storePublicly('setting', 'new');
        } else {
            $header_background = $setting->header_background;
        }


             if ($request->advantage_image) {
            $advantage_image = $request->advantage_image;
            $advantage_image = $advantage_image->storePublicly('setting', 'new');
        } else {
            $advantage_image = $setting->advantage_image;
        }


        $setting->update([

        'website_name'=>$request->website_name,
        'website_email'=>$request->website_email,
        'address'=>$request->address,
        'website_phone'=>$request->website_phone,
        'website_logo'=>$website_logo,
        'header_title'=>$request->header_title,
        'header_subtitle'=>$request->header_subtitle,
        'header_image'=>$header_image,
        'header_background'=>$header_background,
        'about_title'=>$request->about_title,
        'about_image'=>$about_image,
        'about_content'=>$request->about_content,
        'advantage_title'=>$request->advantage_title,
        'advantage_image'=>$advantage_image,
        'advantage_text'=>$request->advantage_text,
        'advantages'=>json_encode($request->advantages),
        ]);
          $message = "Update settings successfully";
        return redirect()->route('Dashboard.setting')->with('msg', $message);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(string $id)
    {
        //
    }
}
