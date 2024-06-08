<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Http\Controllers\Controller;
use App\Models\RestaurantMenu;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class RestaurantController extends Controller
{
    public function AllCategory()
    {
        $categories = RestaurantCategory::latest()->get();

        return view('backend.restaurant.category.all', compact('categories'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1',
            'time' => 'required|between:1,50',
        ]);

        RestaurantCategory::insert([
            'name' => ucwords($request->name),
            'time' => $request->time,
        ]);

        $notification = array(
            'message' => 'Category has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CategoryUpdate(Request $request, $id)
    {
        $field_name = "name$id";
        $field_time = "time$id";

        $request->validate([
            $field_name => 'required|min:1',
            $field_time => 'required|between:1,50',
        ]);

        RestaurantCategory::findOrFail($id)->update([
            'name' => ucwords($request->$field_name),
            'time' => $request->$field_time,
        ]);

        $notification = array(
            'message' => 'Category has been updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function CategoryDelete(Request $request, $id)
    {
        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $category = RestaurantCategory::findOrFail($id);

        // Proceed with deleting the team record
        $category->delete();

        return response()->json(['success' => true, 'message' => "$category->name has been deleted successfully!"]);
    }

    public function AllMenu()
    {
        $all_menus = RestaurantMenu::latest()->get();

        return view('backend.restaurant.menu.all', compact('all_menus'));
    }

    public function AddMenu()
    {
        $categories = RestaurantCategory::latest()->get();

        return view('backend.restaurant.menu.add', compact('categories'));
    }

    public function StoreMenu(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required|between:10,255',
            'image' => 'required|file|mimes:jpg,png,png,gif',
        ]);

        $image = Image::make($request->file('image'))->resize(550, 550)->encode('data-url');

        RestaurantMenu::insert([

            'restaurant_category_id' => $request->category_id,
            'name' => ucwords($request->name),
            'description' => $request->description,
            'price' => number_format($request->price, 2),
            'image' => $image,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Restaurant menu has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('restaurant.menu.all')->with($notification);
    }

    public function EditMenu($id)
    {
        $categories = RestaurantCategory::latest()->get();
        $menu = RestaurantMenu::findOrFail($id);

        return view('backend.restaurant.menu.edit', compact('menu', 'categories'));
    }

    public function UpdateMenu(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required|between:10,255',
            'image' => 'file|mimes:jpg,png,png,gif',
        ]);


        $menu = RestaurantMenu::findOrFail($id);

        if ($request->file('image')) {
            $image = Image::make($request->file('image'))->resize(550, 550)->encode('data-url');

            $menu->update([
                'restaurant_category_id' => $request->category_id,
                'name' => ucwords($request->name),
                'description' => $request->description,
                'price' => number_format($request->price, 2),
                'image' => $image,
                'created_at' => Carbon::now(),
            ]);



            $notification = array(
                'message' => 'Menu has been Updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('restaurant.menu.all')->with($notification);
        } else {

            $menu->update([

                'restaurant_category_id' => $request->category_id,
                'name' => ucwords($request->name),
                'description' => $request->description,
                'price' => number_format($request->price, 2),
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Menu has been Updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('restaurant.menu.all')->with($notification);
        }
    }

    public function DeleteMenuMultiple(Request $request)
    {
        $selectedItems = $request->input('selectedItem', []);
        $c_selected_item = count($selectedItems);

        foreach ($selectedItems as $itemId) {
            $item = RestaurantMenu::findOrFail($itemId);
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

        return redirect()->route('restaurant.menu.all')->with($notification);
    }

    // FRONTEND
    public function Show()
    {
        $categories = RestaurantCategory::all();
        $first_category = RestaurantCategory::first();

        return view('frontend.restaurant.show', compact('categories'));
    }
}
