<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index() {
        return view('login');
    }
    public function header() {
        return view('dashboard/header');
    }
    public function sidebar() {
        return view('dashboard/sidebar');
    }
}