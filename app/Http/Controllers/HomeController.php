<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Customer_transaction;
use App\Category;
use App\Brand;
use App\Template;
use Illuminate\Support\Facades\Mail;
use App\Mail\Marketing;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailable;

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
        'under_warranty' => $request->under_warranty,
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

  public function getCustomerList()
  {
    $header = "customer_list";

    $customer = Customer::paginate(15);

    return view('customer_list',compact('header','customer'));
  }

  public function getCustomerInfo(Request $request)
  {
    $header = "customer_list";

    $customer = Customer::where('id',$request->id)->first();
    $date = new \DateTime($customer->dob);
    $customer->date_birth = $date->format('Y-m-d');
    $date = new \DateTime($customer->created_at);
    $customer->create = $date->format('Y-m-d');
    $date = new \DateTime($customer->updated_at);
    $customer->update = $date->format('Y-m-d');

    $transaction = Customer_transaction::join('category','category.id','=','customer_transaction.category_purchase')
                                        ->join('brand','brand.id','=','customer_transaction.brand_id')
                                        ->select('customer_transaction.*','category.name as category_name','brand.name as brand_name')
                                        ->get();

    return view('customer_info',compact('header','customer','transaction'));
  }

  public function ajaxModifyCustomer(Request $request)
  {
    try{
      $result =  Customer::where('id',$request->id)
                          ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'contact' => "+60".$request->contact,
                            'dob' => $request->dob,
                          ]);

      return $result;

    }catch(Throwable $e){
      report($e);
    }
  }

  public function testmail()
  {
    Mail::to("ycheng391@gmail.com")->send(new Marketing("abc"));

    return "Done";
  }

  public function getUploadTemplate()
  {
    $header = "marketing";

    $template = Template::paginate(15);

    return view('email_template',compact('header','template'));
  }

  public function postUploadTemplate(Request $request)
  {

    $image_path = "public/email/".$request->template_name."/images";
    $path = "public/email/".$request->template_name;
    Storage::makeDirectory("public/email/".$request->template_name."/images");

    foreach($request->template as $result){
      if($result->getClientOriginalExtension() == "html"){
        $full = $result->storeAs($path,$request->template_name.".".$result->getClientOriginalExtension());
      }else{
        $result->storeAs($image_path,$result->getClientOriginalName());
      }
    }

    $content = Storage::get('public/email/'.$request->template_name."/".$request->template_name.".html");

    foreach($request->template as $result){
      if($result->getClientOriginalExtension() != "html"){
        $content = str_replace("images/".$result->getClientOriginalName(),url('storage/email/'.$request->template_name.'/images/'.$result->getClientOriginalName()),$content);
      }
    }

    $content = str_replace("http://www.example.com","https://ntghub.com",$content);
    Storage::put("public/email/".$request->template_name."/".$request->template_name.".html",$content);

    template::updateOrCreate(
      ["template_name" => $request->template_name,],
      [ "category" => 1,
      "dir" => url('storage/email/'.$request->template_name."/".$request->template_name.".html"),
      "path" => 'public/email/'.$request->template_name."/".$request->template_name.".html",
    ]);

    return back()->with('success','pass');
  }

  public function getTestEmail(Request $request)
  {
    $template = Template::where('id',$request->email_id)->first();
    $content = Storage::get($template->path);

    Mail::to($request->email)->send(new Marketing($content));

    if(Mail::failures()){
      return "false";
    }else{
      return "true";
    }
  }

}
