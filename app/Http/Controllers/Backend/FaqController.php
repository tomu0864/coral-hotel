<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FaqController extends Controller
{
    public function All()
    {
        $faqs = Faq::latest()->get();

        return view('backend.faq.all', compact('faqs'));
    }

    public function Add()
    {
        return view('backend.faq.add');
    }

    public function Store(Request $request)
    {
        $request->validate([
            'question' => 'required|between:1,255',
            'answer' => 'required|max:1000',
        ]);

        Faq::insert([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        $notification = array(
            'message' => "FAQ has been added successfully!",
            'alert-type' => 'success'
        );
        return redirect()->route('faq.all')->with($notification);
    }

    public function Edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('backend.faq.edit', compact('faq'));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|between:1,255',
            'answer' => 'required|max:1000',
        ]);

        $faq = Faq::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        $notification = array(
            'message' => "FAQ has been updated successfully!",
            'alert-type' => 'success'
        );
        return redirect()->route('faq.all')->with($notification);
    }

    public function Delete(Request $request, $id)
    {
        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $faq = Faq::findOrFail($id);

        // Proceed with deleting the team record
        $faq->delete();

        return response()->json(['success' => true, 'message' => "FAQ has been deleted successfully!"]);
    }

    public function Show()
    {
        $faqs = Faq::latest()->get();

        return view('frontend.faq.show', compact('faqs'));
    }
}
