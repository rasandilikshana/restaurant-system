<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function index()
{
    return view('chef.dashboard');  // Define a Blade view for Chef Dashboard
}
}
