<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $header = "dashboard";

    return view('home',compact('header'));
  }

  public function getRegisterCustomer()
  {
    $header = "rc";

    return view('register_customer',compact('header'));
  }
}
