<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    // Blog Category
    public function BLogCategory()
    {
        $categories = BlogCategory::latest()->get();

        return view('backend.category.blog_category', compact('categories'));
    }

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' =>  "Category has been added successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function EditBLogCategory($id)
    {
        $categories = BlogCategory::findOrFail($id);

        return response()->json($categories);
    }

    public function UpdateBlogCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $cat_id = $request->cat_id;


        BlogCategory::findOrFail($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' =>  "Category has been updated successfully",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteBLogCategory(request $request, $id)
    {
        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        BlogCategory::findOrFail($id)->delete();

        return response()->json(['success' => true, 'message' => "BLog Category has been deleted successfully!"]);
    }

    // Blog Post

    public function AllBlogPost()
    {
        $posts = BlogPost::latest()->get();

        return view('backend.blog.all', compact('posts'));
    }

    public function AddBlogPost()
    {
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.add', compact('categories'));
    }

    public function StoreBlogPost(Request $request)
    {
        $request->validate([
            'category_id' => 'filled|required',
            'post_title' => 'required|max:100',
            'short_desc' => 'required|max:255',
            'long_desc' => 'required',
            'post_image' => 'required|file|mimes:jpg,jpeg,png, gif',
        ]);

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(550, 370)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([

            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'New post has been added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.post.all')->with($notification);
    }

    public function EditBlogPost($id)
    {
        $categories = BlogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);

        return view('backend.blog.edit', compact('categories', 'post'));
    }

    public function UpdateBlogPost(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'filled|required',
            'post_title' => 'required|max:100',
            'short_desc' => 'required|max:255',
            'long_desc' => 'required',
            'post_image' => 'file|mimes:jpg,jpeg,png, gif',
        ]);

        $blogPost = BlogPost::findOrFail($id);

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 370)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            $img = $blogPost->post_image;
            unlink($img);

            $blogPost->update([

                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog post has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('blog.post.all')->with($notification);
        } else {

            $blogPost->update([

                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog post has been updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('blog.post.all')->with($notification);
        }
    }

    public function DeleteBlogPost(Request $request, $id)
    {

        // Validate the provided password
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!'], 403);
        }

        $blogPost = BlogPost::findOrFail($id);
        $img = $blogPost->post_image;
        unlink($img);

        // Proceed with deleting the team record
        $blogPost->delete();

        return response()->json(['success' => true, 'message' => "$blogPost->post_title has been deleted successfully!"]);
    }

    // Frontend

    public function BlogDetails($slug)
    {
        $blog = BLogPost::where('post_slug', $slug)->firstOrFail();
        $categories = BlogCategory::latest()->get();
        $latest_posts = BlogPost::where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.blog.details', compact('blog', 'categories', 'latest_posts'));
    }

    public function BlogByCategory($category_slug)
    {
        $categories = BlogCategory::latest()->get();
        $category = BlogCategory::where('category_slug', $category_slug)->firstOrFail();
        $blogPosts = BlogPost::where('category_id', $category->id)->latest()->paginate(3);
        $excludedIds = $blogPosts->pluck('id');
        $latest_posts = BlogPost::whereNotIn('id', $excludedIds)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.blog.category_post', compact('category', 'categories', 'blogPosts', 'latest_posts'));
    }

    public function BlogList(Request $request)
    {
        if ($request->search) {
            $blogPosts = BlogPost::latest()
                ->where(function ($query) use ($request) {
                    $query->where('post_title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('short_desc', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(3);
        } else {
            $blogPosts = BLogPost::latest()->paginate(3);
        }
        $categories = BlogCategory::latest()->get();
        $latest_posts = BlogPost::latest()->take(3)->get();

        return view('frontend.blog.list', compact('blogPosts', 'categories', 'latest_posts', 'request'));
    }
}
