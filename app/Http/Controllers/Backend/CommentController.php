<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function CommentStore(Request $request, $id)
    {

        $request->validate([
            'message' => 'required|max:5000',
        ]);

        Comment::insert([

            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Your comment has been added successfully, we will approve',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CommentUpdate(Request $request, $id)
    {

        $field_name = "message$id";

        $request->validate([
            $field_name => 'required|max:5000',
        ]);

        Comment::findOrFail($id)->update([

            'user_id' => Auth::user()->id,
            'message' => $request->$field_name,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Your comment has been updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CommentDelete($id)
    {
        Comment::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Your comment has been delete successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function AllComment()
    {
        $comments = Comment::latest()->get();

        return view('backend.comment.all', compact('comments'));
    }

    public function UpdateCommentStatus(Request $request)
    {
        $commentId = $request->input('comment_id');
        $isChecked = $request->input('is_checked', 0);

        $comment = Comment::findOrFail($commentId);
        if ($comment) {
            $comment->status = $isChecked;
            $comment->save();
        }

        if ($isChecked) {
            return response()->json(['message' => 'The comment has been approved!']);
        } else {
            return response()->json(['message' => 'Comment has been disapproved']);
        }
    }
}
