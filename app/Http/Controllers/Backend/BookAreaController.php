<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookArea;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BookAreaController extends Controller
{
    public function BookArea()
    {
        $book = BookArea::find(1);

        return view('backend.bookarea.book_area', compact('book'));
    }

    public function BookAreaUpdate(Request $request)
    {
        $book_id = $request->id;

        if ($request->file('image')) {
            $image = Image::make($request->file('image'))->resize(1000, 1000)->encode('data-url');

            BookArea::findOrFail($book_id)->update([


                'subtitle'    => $request->subtitle,
                'main_title'  => $request->main_title,
                'short_desc'  => $request->short_desc,
                'link_url'   => $request->link_url,
                'image'       => $image,
            ]);

            $notification = array(
                'message' => 'Book Area has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            BookArea::findOrFail($book_id)->update([

                'subtitle'    => $request->subtitle,
                'main_title'  => $request->main_title,
                'short_desc'  => $request->short_desc,
                'link_url'   => $request->link_url,
            ]);

            $notification = array(
                'message' => 'Book Area has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
