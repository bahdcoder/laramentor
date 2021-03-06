<?php

namespace App\Http\Controllers;

use App\MentorshipRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')
            ->withMentorshipRequests(MentorshipRequest::pending()->with('skills', 'interests', 'user')->get());
    }
}
