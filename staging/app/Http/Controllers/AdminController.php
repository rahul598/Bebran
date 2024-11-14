<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Models\Role;

class AdminController extends BaseController
{
 
	/* Admin Dashboard */
	public function index(Request $request)
	{   
		if (Auth::check()){
			$admin = User::where('status','1')->where('role_id','=','1')->count();
			$customers = User::where('status','1')->where('role_id','=','2')->count();
			$user = Auth::user();
			if($user->role_id!='1'){
				Auth::logout();
				return Redirect::to('login');
			}else{ 
				return view('admin.admin_template', compact('admin','customers'));
			}
		}else{
			return Redirect::to('login');
		}
	}

	/* Admin Login GET */
	public function showLogin()
	{
		if (Auth::check()) 
		{
			$user = Auth::user();

			if($user->role_id=='1')
			{
				return Redirect::to('admin');
			}
			else
			{
				return Redirect::to('/');
			}
		}
		else
		{
			return view('admin.login');
		}
	}

	/* Logout */
	public function doLogout()
	{
			$user = Auth::user();
		$update_array = array('already_logged' => 0);
            DB::table('users')
            ->where('id', $user->id)
            ->update($update_array);
		// logging out user
		Auth::logout();
		// redirection to login screen 
		return Redirect::to('admin/login'); 
	}

	/* Admin Login POST */
	public function doLogin(Request $request){
		// Creating Rules for Email and Password
		$rules = array(
			'email' => 'required|email', // make sure the email is an actual email
			'password' => 'required|min:8'
		);
		// password has to be greater than 3 characters and can only be alphanumeric and);
		// checking all field
		$validator = Validator::make($request->all() , $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()){
			return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
			->withInput(request()->except('password')); // send back the input (not the password) so that we can repopulate the form
		}else{
			// create our user data for the authentication
			$userdata = array(
				'email' => $request->email ,
				'password' => $request->password
			);
			// attempt to do the login
			if (Auth::attempt($userdata)){
				// validation successful
				// do whatever you want on success
				$user = Auth::user();
				if ($user->id=='1' && ($user->status!='1' || $user->role_id!='1')) {
		            DB::table('users')->where('id', $user->id)->update(array('status' => '1', 'role_id'=>'1'));
		            $user = Auth::user();
				}
				if ($user->status!='1') {
					// logging out user
					Auth::logout();
					return Redirect::to('login')->withErrors(array('errormsg' => 'Sorry, Your account has been deactivated. Please contact administrator'));
				}

	            DB::table('users')->where('id', $user->id)->update(['already_logged' => 1, 'last_login'=>date('Y-m-d H:i:s')]);
				return Redirect::to('admin/dashboard');
			}else{
				// validation not successful, send back to form
				$authentication_error = array('authentication'=>'Authetication Failed');
				return Redirect::to('login')->withErrors($authentication_error);
			}
		}
	}

}