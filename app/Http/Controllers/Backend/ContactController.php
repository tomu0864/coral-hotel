<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function ContactUs()
    {
        $site = SiteSetting::first();
        return view('frontend.contact.contact_us', compact('site'));
    }

    public function Store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
                'check' => 'required',
            ],
            [
                'check.required' => 'Please check Terms & Conditions And Privacy Policy.'
            ]
        );

        Contact::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Your message sent successfully. Plese wait for our reply!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ContactMessage()
    {
        $messages = Contact::latest()->get();

        return view('backend.contact.message', compact('messages'));
    }

    public function UpdateContactMessageStatus(Request $request)
    {
        $messageId = $request->input('message_id');
        $isChecked = $request->input('is_checked', 0);

        $message = Contact::findOrFail($messageId);
        if ($message) {
            $message->status = $isChecked;
            $message->save();
        }
        if ($isChecked) {
            return response()->json(['message' => 'Make sure to response to guest!']);
        } else {
            return response()->json(['message' => 'The message has been unread.']);
        }
    }
}
