<?php

namespace App\Http\Controllers\Backend\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        return view('contents.backend.operator.dashboard.index');
    }
}
