<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendapatanCotroller extends Controller
{
      public function index() {
        return view('pendapatan.index');
    }
}
