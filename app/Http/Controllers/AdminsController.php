<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Session;
use Redirect;
use App\User;
use App\Job;
use App\Field;
use App\Alert;
use App\Admin;
use App\Customer;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;

class AdminsController extends Controller{

    public function index(){
    
        $user = Auth::user();
        if(!$user || $user->type != 1){
            Session::flash('error', 'Sorry! You do not have access to this page');
            return redirect('/login');
        }
        $loggedInUser = Admin::join("users", "admins.user_id", "=", "users.id")
                        ->where("admins.user_id", $user->id)
                        ->select("admins.*", "users.id as user_id", "users.status as user_status")->first();
       return view('admin/index')->with(["loggedInUser"=>$loggedInUser]);
    }

    public function jobs(){
    
        $user = Auth::user();
        if(!$user || $user->type != 1){
            Session::flash('error', 'Sorry! You do not have access to this page');
            return redirect('/login');
        }
        $loggedInUser = Admin::join("users", "admins.user_id", "=", "users.id")
                        ->where("admins.user_id", $user->id)
                        ->select("admins.*", "users.id as user_id", "users.status as user_status")->first();

        $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
        ->select("jobs.*", "fields.name as field_name", "states.name as state_name")->orderBy("created_at", "DESC")->get();
       return view('admin/jobs')->with(["loggedInUser"=>$loggedInUser, "jobs"=>$jobs]);
    }

    public function newJob(){
    
        $user = Auth::user();
        if(!$user || $user->type != 1){
            Session::flash('error', 'Sorry! You do not have access to this page');
            return redirect('/login');
        }
        $loggedInUser = Admin::join("users", "admins.user_id", "=", "users.id")
                        ->where("admins.user_id", $user->id)
                        ->select("admins.*", "users.id as user_id", "users.status as user_status")->first();

        $fields = Field::where("status",1)->get();
        $states = State::all();
       return view('admin/new_job')->with(["loggedInUser"=>$loggedInUser, "fields"=>$fields, "states"=>$states]);
    }


    public function adminMail($email, $name, $password){
        $sender = 'info@cashluck.com.ng';
        $data = [
        'email'=> $email,
        'name'=>$name,
        'password'=> $password,
        'date'=>date('Y-m-d')
        ];
 
        Mail::send('welcome-mail-password', $data, function($message) use($data){
            $message->from('hmd@latikash.com', 'Latikash');
            $message->SMTPDebug = 4; 
            $message->to($data['email']);
            $message->subject('Account Creation');
        });
    }

    public function saveJob(Request $request){

        $job = new Job;
        $job->title = $request->input("title");
        $job->field_id = $request->input("field_id");
        $job->state_id = $request->input("state_id");
        $job->company = $request->input("company");
        $job->education = $request->input("education");
        $job->experience = $request->input("experience");
        $job->type = $request->input("type");
        $job->application_type = $request->input("application_type");
        $job->email = $request->input("email");
        $job->website = $request->input("website");
        $job->site = $request->input("site");
        $job->description = $request->input("description");
        $job->status = 1;
        
        if($job->save()){
            $this->sendPush("New job",$job->title,$job->field_id );
            Session::flash('success', 'Job created sucessfully');
            return back();
        }else{
            Session::flash('error', 'Sorry! An error occured');
            return back();
        }   

    }

    public function sendPush($title, $body, $field_id){
        $subscribers = Alert::where("field_id", $field_id)->get();
        foreach($subscribers as $subscriber){
            $customer = Customer::where("id", $subscriber->customer_id)->first();
            $job = Job::where("id", 1)->first();
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

                $notification = [
                    'title' => $title,
                    "body" =>$body,
                    "soundname"=> "default",
                    "sound"=> "default",
                    "ledColor"=> [0,0,255,0],
                ];
                //$extraNotificationData = ["message" => $notification];

                $fcmNotification = [
                    //'registration_ids' => $tokenList, //multple token array
                    'to'        => $customer->push_token, //single token
                    'notification' => $notification,
                    'data' => $job
                ];
                $headers = [
                    'Authorization: key=AAAA0q0MBXI:APA91bFw6eo87RAddnGbiuWqh4v1B8M-Jh2WLeEhIiCnbdvYowf4txm8hSTUPZim-RAmzs311m__nx2pkFPYbKs459R_p7pFyDeNy_IcJ9bF8vTvTqdrzFpvptvXR5sWBXORGVnkR5JJ',
                    'Content-Type: application/json'
                ];
        
        
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                //var_dump($result);
                curl_close($ch);
        }
    
    }  

    public function resetMail(Request $request){

        
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        
        $user_id = $user->id;

        $token = time();

        $user = User::where('id', $user_id)->first();

        $user->token = $token;

        $user->save();
        
        $sender = 'yinka@theaffinityclub.com';
        
        
 
        $data = [
        'email'=> $email,
        'token'=> $token,
        'date'=>date('Y-m-d')
        
        
        ];
 
        Mail::send('reset-password', $data, function($message) use($data){
            
            $message->from('hmd@latikash.com', 'Latikash');
            $message->SMTPDebug = 4; 
            $message->to($data['email']);
            $message->subject('Password Recovery');
 
            Session::flash('success', 'An Email has been sent to your account. Pls check to proceed');
        
            return view('/');
        });
    }   
}
