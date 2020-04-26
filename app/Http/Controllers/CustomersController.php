<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Session;
use Redirect;
use App\User;
use App\Job;
use App\Alert;
use App\SavedJob;
use App\Field;
use App\Admin;
use App\Customer;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;

class CustomersController extends Controller{

    public function fields(){
        $fields = Field::orderBy("name", "ASC")->get();
        return response()->json(['success' => true, "fields"=> $fields]);
    }

    public function states(){
        $states = State::orderBy("name", "ASC")->get();
        return response()->json(['success' => true, "states" => $states]);
    }

    public function jobs($initial, $field_id, $state_id, $search){
        $next = $initial + 10;
        $search = str_replace('%20', ' ', $search);
        //return "a".$state_id;
        if($search == "null" && $field_id == '0' && $state_id == '0'){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }elseif($search != "null" && $field_id == "0" && $state_id == "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where(function ($query) use ( $field_id, $state_id, $search) {
                        $query->where("jobs.title", 'like', '%' . $search . '%')
                        ->orWhere("jobs.company", 'like', '%' . $search . '%')
                        ->orWhere("jobs.education", 'like', '%' . $search . '%')
                        ->orWhere("jobs.type", 'like', '%' . $search . '%')
                        ->orWhere("fields.name", 'like', '%' . $search . '%')
                        ->orWhere("states.name", 'like', '%' . $search . '%');
                    })
                    ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }elseif($search == "null" && $field_id != "0" && $state_id == "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where("jobs.field_id", $field_id)
                    ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }
        elseif($search == "null" && $field_id == "0" && $state_id != "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where("jobs.state_id", $state_id)
                    ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }elseif($search != "null" && $field_id != "0" && $state_id != "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where("jobs.state_id", $state_id)
                    ->where("jobs.field_id", $field_id)
                    ->where(function ($query) use ( $field_id, $state_id, $search) {
                        $query->where("jobs.title", 'like', '%' . $search . '%')
                        ->orWhere("jobs.company", 'like', '%' . $search . '%')
                        ->orWhere("jobs.education", 'like', '%' . $search . '%')
                        ->orWhere("jobs.type", 'like', '%' . $search . '%')
                        ->orWhere("fields.name", 'like', '%' . $search . '%')
                        ->orWhere("states.name", 'like', '%' . $search . '%');
                    })
                   ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }elseif($search != "null" && $field_id == "0" && $state_id != "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where("jobs.state_id", $state_id)
                    ->where(function ($query) use ( $field_id, $state_id, $search) {
                        $query->where("jobs.title", 'like', '%' . $search . '%')
                        ->orWhere("jobs.company", 'like', '%' . $search . '%')
                        ->orWhere("jobs.education", 'like', '%' . $search . '%')
                        ->orWhere("jobs.type", 'like', '%' . $search . '%')
                        ->orWhere("fields.name", 'like', '%' . $search . '%')
                        ->orWhere("states.name", 'like', '%' . $search . '%');
                    })
                   ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }elseif($search != "null" && $field_id != "0" && $state_id == "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where("jobs.field_id", $field_id)
                    ->where(function ($query) use ( $field_id, $state_id, $search) {
                        $query->where("jobs.title", 'like', '%' . $search . '%')
                        ->orWhere("jobs.company", 'like', '%' . $search . '%')
                        ->orWhere("jobs.education", 'like', '%' . $search . '%')
                        ->orWhere("jobs.type", 'like', '%' . $search . '%')
                        ->orWhere("fields.name", 'like', '%' . $search . '%')
                        ->orWhere("states.name", 'like', '%' . $search . '%');
                    })
                   ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }
        elseif($search == "null" && $field_id != "0" && $state_id != "0"){
            $jobs = Job::join("states", "jobs.state_id", "=", "states.id")
                    ->join("fields", "jobs.field_id", "=", "fields.id")
                    ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
                    ->where("jobs.field_id", $field_id)
                    ->where("jobs.state_id", $state_id)
                   ->orderBy("created_at", "DESC")
                    ->take($next)
                    ->get();
                    return response()->json(['success' => true, "jobs"=>$jobs]);
        }     
          
    }

    public function mobileSaveJob($job_id, $customer_id){
        $check = SavedJob::where(["job_id"=> $job_id, "customer_id"=> $customer_id])->count();
        if($check > 0){
            return response()->json(['success' => 'This job has already been saved to your profile']);
        }
        $job = new SavedJob;
        $job->job_id = $job_id;
        $job->customer_id = $customer_id;
        if($job->save()){
            return response()->json(['success' => 'Job has been saved to your profile']);
        }else{
            return response()->json(['error' => 'Sorry! Could not save job to your profile at the moment']);
        }
    }
    public function mobileGetSavedJobs($initial, $customer_id){
        $next = $initial + 10;
        $jobs = SavedJob::join("jobs", "saved_jobs.job_id", "jobs.id")->join("states", "jobs.state_id", "=", "states.id")
        ->join("fields", "jobs.field_id", "=", "fields.id")
        ->select("jobs.*", "fields.name as field_name", "states.name as state_name")
        ->where("customer_id", $customer_id)
        ->orderBy("created_at", "DESC")->take($next)
        ->get();
        return response()->json(['success' => 'Success', 'jobs' => $jobs]);
    }

    public function mobileGetSubscribedAlerts($customer_id){
        $fields = Field::orderBy("fields.name", "ASC")->get();
        foreach($fields as $key => $field){
            $alert = Alert::where(["customer_id"=> $customer_id, "field_id"=>$field->id])->first();
            if($alert != null){
                $fields[$key]['alert'] = $alert;
            }
        }
        return response()->json(['success' => 'Success', 'fields' => $fields]);
    }

    public function mobileSubscribe($field_id, $customer_id){
        $alert = new Alert;
        $alert->customer_id = $customer_id;
        $alert->field_id = $field_id;
        if($alert->save()){
            $fields = Field::orderBy("fields.name", "ASC")->get();
            foreach($fields as $key => $field){
                $alert = Alert::where(["customer_id"=> $customer_id, "field_id"=>$field->id])->first();
                if($alert != null){
                    $fields[$key]['alert'] = $alert;
                }
                // else{
                //     $fields[$key]['alert'] = null;
                // }
            }
            return response()->json(['success' => 'Success', 'fields' => $fields]);
        }
    }

    public function mobileUnsubscribe($field_id, $customer_id){
        $alert = Alert::where(["customer_id"=>$customer_id, "field_id"=>$field_id])->delete();
        
        $fields = Field::orderBy("fields.name", "ASC")->get();
        foreach($fields as $key => $field){
            $alert = Alert::where(["customer_id"=> $customer_id, "field_id"=>$field->id])->first();
            if($alert != null){
                $fields[$key]['alert'] = $alert;
            }
        }
        return response()->json(['success' => 'Success', 'fields' => $fields]);
        
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
            Session::flash('success', 'Job created sucessfully');
            return back();
        }else{
            Session::flash('error', 'Sorry! An error occured');
            return back();
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
