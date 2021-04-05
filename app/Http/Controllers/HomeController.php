<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Customer_transaction;
use App\Category;
use App\Brand;

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

  public function postRegisterCustomer(Request $request)
  {
    try{
      Customer::create([
        'name' => $request->customer_name,
        'email' => $request->customer_email,
        'contact' => $request->customer_contact,
        'dob' => $request->customer_dob,
        'card_id' => $request->card_id,
        'card_code' => $request->card_code,
      ]);

      return back()->with('success','true');

    }catch(Throwable $e){
      
      report($e);

    }
  }

  public function getVerification()
  {
    $header = 'verification';

    $category = Category::get();

    $brand = Brand::get();

    return view('verification',compact('header','category','brand'));
  }

  public function postVerification(Request $request)
  {
    try{

      Customer_transaction::create([
        'customer_id' => $request->user_id,
        'category_purchase' => $request->category_id,
        'brand_id' => $request->brand_id,
        'serial_code' => $request->serial_code,
        'notes' => $request->notes,
        'warranty_end_date' => $request->warranty,
      ]);

      return back()->with('success','true');
      
    }catch(Throwable $e){

      report($e);

    }

  }

  public function getCustomerDetails(Request $request)
  {
    $result = new \stdClass();

    if($request->member_id == null){
      $result = Customer::where('card_code',$request->card_code)->first();
      if($result != null){
        $date = new \DateTime($result->dob);
        $result->datetime = $date->format('d-M-Y');
        $date = new \DateTime($result->created_at);
        $result->register = $date->format('d-M-Y');
      }else{
        return json_encode($result);
      }

    }else if($request->card_code == null){
      $result = Customer::where('card_id',$request->member_id)->first();
      if($result != null){
        $date = new \DateTime($result->dob);
        $result->datetime = $date->format('d-M-Y');
        $date = new \DateTime($result->created_at);
        $result->register = $date->format('d-M-Y');
      }else{

        return json_encode($result);
      }
    }

    return $result;
  }


}
