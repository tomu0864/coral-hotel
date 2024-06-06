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
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/bookarea/' . $name_gen);
            $save_url = 'upload/bookarea/' . $name_gen;

            BookArea::findOrFail($book_id)->update([


                'subtitle'    => $request->subtitle,
                'main_title'  => $request->main_title,
                'short_desc'  => $request->short_desc,
                'link_url'   => $request->link_url,
                'image'       => $save_url,
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
