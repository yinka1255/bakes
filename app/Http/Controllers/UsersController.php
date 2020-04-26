<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Session;
use Redirect;
use App\User;
use App\Customer;
use App\Admin;
use App\Video;
use App\CustomerVideo;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mail;

class UsersController extends Controller{

    public function index(){
        return view('index');
    }
    public function about(){
        return view('about');
    }


    public function terms(){
        return view('terms');
    }

    public function faq(){
        return view('faq');
    }

    public function contact(){
        return view('contact');
    }

    public function register(){
        $states = State::all();
        return view('register')->with('states', $states);
    }

    public function saveCustomer(Request $request){

        if(empty($request->input("email")) || empty($request->input("name")) || empty($request->input("phone")) || empty($request->input("state"))
        || empty($request->input("address"))){
            Session::flash('error', 'Sorry! Kindly note that all fields are required');
            return back();
        }
        // if($request->input("password") != $request->input("cpass")){
        //     Session::flash('error', 'Sorry! the provided passwords do not match');
        //     return back();
        // }
        $user = new User;
        $user->email = $request->input("email");

        $check = User::where("email", $request->input("email"))->count();

        if($check > 0){
            Session::flash('error', 'Sorry! the provided email already exist');
            return back();
        }
        $user->password = bcrypt($request->input("password"));
        $user->status = 1;
        $user->type = 3;
        if($user->save()){
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->email = $request->input("email");
            $customer->name = $request->input("name");
            $customer->phone = $request->input("phone");
            $customer->state = $request->input("state");
            $customer->address = $request->input("address");
            if($customer->save()){
                Auth::loginUsingId($user->id);
                $this->sendWelcomeMail($customer);
                
                Session::flash('success', 'Thank you for being a part of Latikash');
                return redirect('/');
            }else{
                Session::flash('error', 'Sorry! An error occured while trying to save your information. Kindly contact administrator');
                return back();
            }
        }     
    }

    public function mobileRegister(Request $request){

        $user = new User;
        $user->email = $request->input("email");

        $check = User::where("email", $request->input("email"))->count();

        if($check > 0){
            return response()->json(['error' => 'Sorry! The provided email already exist']);
        }
        $user->password = bcrypt($request->input("password"));
        $user->status = 1;
        $user->type = 1;
        if($user->save()){
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->email = $request->input("email");
            $customer->name = $request->input("name");
            $customer->push_token = $request->input("pushToken");
            $customer->status = 1;
            if($customer->save()){
                //$this->sendWelcomeMail($customer);
                return response()->json(['success' => 'Thank! Your registration was successfull', 'customer'=>$customer]);
            }else{
                return response()->json(['error' => 'Sorry! An error occured while trying to save your information. Kindly contact administrator']);
            }
        }     
    }

    public function sendWelcomeMail($customer){
        $data = [
        'email'=> $customer->email,
        'name'=> $customer->name,
        'date'=>date('Y-m-d')
        ];
 
        Mail::send('welcome-mail', $data, function($message) use($data){
            $message->from('hmd@latikash.com', 'Latikash');
            $message->SMTPDebug = 4; 
            $message->to($data['email']);
            $message->subject('Welcome to Latikash');
            //return response()->json(["succeess"=>'An Email has been sent to your account. Pls check to proceed']);
        });   
    }

    public function mobileVideos($customer, $initial, $search){
        $next = $initial + 1;
        if($search == "none" || $search == ""){
            $videos = Video::where("status", 1)->take($next)->get();
        }else{
            $videos = Video::where(["status"=> 1])->where("name", "LIKE", "%$search%")->take($next)->get();
        }
        if($customer != 1){
            $history = CustomerVideo::join("videos", "videos.video_id", "customer_videos.video_id")
            ->where("customer_videos.customer", $customer)->take($next)->get();
            return response()->json(['success' => 'Sucess', "videos"=>$videos, "history"=>$history ]);
        }else{
            return response()->json(['success' => 'Sucess', "videos"=>$videos ]);
        }
    }

    public function saveHistory($customer, $video_id){
        $check = CustomerVideo::where(["customer"=>$customer, "video_id"=>$video_id])->first();
        if($check != null){
            return;
        }
        $history = new CustomerVideo;
        if($customer == 1){
            $history->customer = time();
        }else{
            $history->customer = $customer;
        }
        $history->video_id = $video_id;
        if($history->save()){
            return response()->json(["customer"=>$history->customer ]);
        }else{

        }
    }

    public function reset(Request $request){

        if(empty($request->input("email"))){
            return response()->json(['error' => 'Kindly provide your email address']);
        }
        $user = User::where("email", $request->input("email"))->first();
        if($user == null){
            return response()->json(['error' => 'No user is associated with the email you provided']);
        }
        $token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 4)), 0, 4);
        $user->password = bcrypt($token);
        $user->save();
        if($user->type == 3){
            $customer = Customer::where("customer_id", $user->id)->first();
            $this->sendResetMail($customer, $token);
        }
        return response()->json(['successs' => 'Kindly check your email for your new password']);
    }

    public function sendResetMail($customer, $token){
        $data = [
        'email'=> $customer->email,
        'name'=> $customer->name,
        'token'=> $token,
        'date'=>date('Y-m-d')
        ];
 
        Mail::send('reset-mail', $data, function($message) use($data){
            $message->from('info@ngjobs.com', 'Myjobmag');
            $message->SMTPDebug = 4; 
            $message->to($data['email']);
            $message->subject('Password Recovery');
            
        });   
    }

    public function profile(){
        $user = Auth::user();
        return view('profile')->with('user', $user);
    }
}
