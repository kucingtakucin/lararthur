<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('contents.frontend.home.index');
    }
}
