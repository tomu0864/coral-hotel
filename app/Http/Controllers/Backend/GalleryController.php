<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class GalleryController extends Controller
{
    public function AllGallery()
    {
        $galleries = Gallery::latest()->get();
        return view('backend.gallery.all', compact('galleries'));
    }

    public function AddGallery()
    {
        return view('backend.gallery.add');
    }

    public function StoreGallery(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'photo' => 'required',
        ]);

        $images = $request->file('photo');

        foreach ($images as $img) {
            $image = Image::make($img)->resize(550, 550)->encode('data-url');

            Gallery::insert([
                'category_name' => $request->category_name,
                'photo' => $image,
            ]);
        }

        $notification = array(
            'message' => 'A new gallery has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('gallery.all')->with($notification);
    }

    public function EditGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit', compact('gallery'));
    }

    public function UpdateGallery(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->file('photo')) {
            $image = Image::make($request->file('photo'))->resize(550, 550)->encode('data-url');

            $gallery->update([
                'category_name' => $request->category_name,
                'photo' => $image,
            ]);



            $notification = array(
                'message' => 'The gallery has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('gallery.all')->with($notification);
        } else {

            $gallery->update([
                'category_name' => $request->category_name,
            ]);

            $notification = array(
                'message' => 'The gallery has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('gallery.all')->with($notification);
        }
    }

    public function DeleteGalleryMultiple(Request $request)
    {
        $selectedItems = $request->input('selectedItem', []);
        $c_selected_item = count($selectedItems);

        foreach ($selectedItems as $itemId) {
            $item = Gallery::findOrFail($itemId);
            $item->delete();
        }

        if ($c_selected_item == 1) {
            $notification = array(
                'message' => "$c_selected_item item has been deleted successfully",
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => "$c_selected_item items has been deleted successfully",
                'alert-type' => 'success'
            );
        }

        return redirect()->route('gallery.all')->with($notification);
    }

    public function showGallery()
    {
        $room_gallery = Gallery::where('category_name', 'room')->latest()->get();
        $restaurant_gallery = Gallery::where('category_name', 'restaurant')->latest()->get();
        $facility_gallery = Gallery::where('category_name', 'facility')->latest()->get();

        return view('frontend.gallery.show', compact('room_gallery', 'restaurant_gallery', 'facility_gallery'));
    }
}
