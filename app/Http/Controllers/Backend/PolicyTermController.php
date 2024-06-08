<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use App\Models\TermsCondition;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class PolicyTermController extends Controller
{
    // Backend
    public function EditPolicy()
    {
        $policy = PrivacyPolicy::first();

        return view('backend.policy.edit', compact('policy'));
    }

    public function UpdatePolicy(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        PrivacyPolicy::findOrFail($id)->update([
            'content' => $request->content,
        ]);

        $notification = array(
            'message' => 'Private policy has been updated succesfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function EditTerm()
    {
        $term = TermsCondition::first();

        return view('backend.terms.edit', compact('term'));
    }

    public function UpdateTerm(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'file|max:1048|mimes:jpg,jpeg,png,gif',
        ]);

        $term = TermsCondition::findOrFail($id);

        if ($request->file('image')) {
            $image = Image::make($request->file('image'))->resize(1140, 700)->encode('data-url');

            $term->update([
                'content' => $request->content,
                'image' => $image,
                'updated_at' => Carbon::now(),
            ]);
        } else {

            $term->update([
                'content' => $request->content,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Terms & Conditions have been updated succesfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    // Frontend
    public function PolicyShow()
    {
        return view('frontend.policy.show');
    }

    public function TermsShow()
    {
        return view('frontend.terms.show');
    }
}
