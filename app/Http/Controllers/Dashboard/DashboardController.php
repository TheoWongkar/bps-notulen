<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Judul Halaman
        $title = "Dashboard";

        return view('dashboard', compact('title'));
    }
}
