<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function SettingSmtp()
    {
        $smtp = SmtpSetting::first();
        return view('backend.setting.smtp', compact('smtp'));
    }

    public function SettingSmtpUpdate(Request $request, $id)
    {
        $smtp = SmtpSetting::findOrFail($id);

        $smtp->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = array(
            'message' => "Smtp setting has been updated successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SettingSite()
    {
        $site = SiteSetting::first();
        return view('backend.setting.site', compact('site'));
    }

    public function SettingSiteUpdate(Request $request, $id)
    {
        $site = SiteSetting::findOrFail($id);

        if ($request->file('image')) {
            $image = Image::make($request->file('image'))->resize(110, 44)->encode('data-url');

            $site->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'address' => $request->address,
                'copyright' => $request->copyright,
                'logo' => $image,
            ]);



            $notification = array(
                'message' => 'Site setting has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            $site->update([

                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'address' => $request->address,
                'copyright' => $request->copyright,
            ]);

            $notification = array(
                'message' => 'Site setting has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
