<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Redirect;
use Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $rules = [
            'fname' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'confirmed', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 'confirmed'],
            'aggrement' => 'required',
        ];
        
        $customMessages = [
            'fname.required' => 'Please enter first name',
            'email.required' => 'Please enter email address',
            'email.unique' => 'The email is already in use on the system. Please use a different email.',
            'password.regex' => 'The :attribute field must have: a minimum of 1 lower case letter [a-z] and a minimum of 1 upper case letter [A-Z] and a minimum of 1 numeric character [0-9] and a minimum of 1 special character: ~`!@#$%^&*()-_+={}[]|\;:"<>,./?',
            'aggrement.required' => 'Please agree to the Terms & Conditions.',
        ];
        
        return Validator::make($data, $rules, $customMessages);
    }

    protected function create(array $data)
    {
        $role_id = 2;
        $status = '1';

        $fname = $data['fname'];
        $mname = $data['mname'];
        $lname = $data['lname'];
        $name = trim($fname . ' ' . $mname);
        $name = trim($name . ' ' . $lname);

        $user = new User();
        $user->role_id = $role_id;
        $user->fname = $fname;
        $user->mname = $mname;
        $user->lname = $lname;
        $user->name = $name;
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];
        $user->password = Hash::make($data['password']);
        $user->status = $status;
        $user->save();

        $obj = new Event;
        $obj->user_id = $user->id;
        $obj->website_slug = $data['website_slug'];
        $obj->event_date = date('Y-m-d', strtotime($data['event_date']));
        $obj->base = 1;
        $obj->payment_status = 3;
        $obj->menu_order = 1;
        $obj->save();

        $data['fullname'] = $name;
        Mail::to($data['email'])->send(new WelcomeMail($data));
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        Auth::login($this->create($request->all()));    

        // Flash a success message
        session()->flash('success', 'You are registered successfully.');

        // Redirect to the intended page or home
        return redirect()->route('home'); // Change 'home' as needed
    }
}
