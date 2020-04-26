<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\Customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class LoginsController extends Controller
{

    /**
	 * Handles authentication attempt
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function authenticate(Request $request){
    	$email = $request->input('email');
        $password = $request->input('password');
    	if (Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            if($user->status == 2){
                Session::flash('error', 'Sorry! Your account has been deactivated');
                return back();
            }   
            return redirect('admin/index');
        }else{		
                Session::flash('error', 'Authentication failed. Kindly try again with valid details');
                return back();
        }

    }

    public function mobileAuthenticate(Request $request){
    	$email = $request->input('email');
        $password = $request->input('password');
    	if (Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            
            if($user->status == 2){
                return response()->json(['error' => 'Sorry! Your account has been deactivated. Kindly contact administrator']);
            }   
            if($user->type == 2){
                $customer = Customer::where("user_id", $user->id)->first();
                $customer->push_token = $request->input('pushToken');
                $customer->save();
                return response()->json(['success' => 'Authentication was successfull', 'customer'=>$customer]);
            }else{
                return response()->json(['error' => 'Sorry! You do not have a customer account']);
            }
        }else{		
            return response()->json(['error' => 'Sorry! Authentication failed... Kindly try again']);
        }

    }
    

    public function logout(){
    	Auth::logout();
        return redirect('/login');
    }
}
