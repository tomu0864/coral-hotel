<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function Store($blog_id)
    {
        $this->like->user_id = Auth::user()->id;
        $this->like->blog_post_id = $blog_id;
        $this->like->save();

        return redirect()->back();
    }

    public function Delete($blog_id)
    {
        //destroy(primary key/Id) Can't use
        $this->like->where('user_id', Auth::user()->id)
            ->where('blog_post_id', $blog_id)
            ->delete();

        return redirect()->back();
    }
}
