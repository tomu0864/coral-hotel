<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function AllTestimonial()
    {
        $testimonials = Testimonial::latest()->get();

        return view('backend.testimonial.all', compact('testimonials'));
    }

    public function AddTestimonial()
    {
        return view('backend.testimonial.add');
    }

    public function StoreTestimonial(Request $request)
    {
        $image = Image::make($request->file('image'))->resize(50, 50)->encode('data-url');

        Testimonial::insert([

            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $image,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Testimonial has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('testimonial.all')->with($notification);
    }

    public function EditTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit', compact('testimonial'));
    }

    public function UpdateTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($request->file('image')) {
            $image = Image::make($request->file('image'))->resize(50, 50)->encode('data-url');

            $testimonial->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'image' => $image,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Testimonial has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('testimonial.all')->with($notification);
        } else {

            $testimonial->update([

                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Testimonial has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('testimonial.all')->with($notification);
        }
    }

    public function DeleteTestimonial(Request $request, $id)
    {

        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();

        return response()->json(['success' => true, 'message' => "Testimonial has deleted successfully!"]);
    }

    // Frontend(show Testimonial list)
    public function TestimonialList()
    { {
            $latest_testimonial = Testimonial::latest()->take(2)->get();
            $excludedIds = $latest_testimonial->pluck('id');
            $testimonial = Testimonial::whereNotIn('id', $excludedIds)->latest()->paginate(3);

            return view('frontend.testimonial.list', compact('testimonial', 'latest_testimonial'));
        }
    }
}
