<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
        $teams = Team::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->get();

        return view('frontend.about.show', compact('teams', 'testimonials'));
    }
}
