<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
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
     * Display all the static pages when authenticated.
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        // Check if the view exists
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }

        // Return a 404 error if the page does not exist
        return abort(404);
    }
}
