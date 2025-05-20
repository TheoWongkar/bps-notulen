<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        // Judul Halaman
        $title = "Login";

        return view('login', compact('title'));
    }
}
