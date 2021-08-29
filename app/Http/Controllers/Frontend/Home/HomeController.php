<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contents.frontend.home.index');
    }
}
