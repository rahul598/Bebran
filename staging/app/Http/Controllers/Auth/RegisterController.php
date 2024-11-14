<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Event;
use App\Models\Page;
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
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = array(
            'fname' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'confirmed', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 'confirmed'],
            'aggrement' => 'required',
        );
        $customMessages = array(
            'fname.required'  => 'Please enter first name',
            'mname.required'  => 'Please enter middle name',
            'lname.required'  => 'Please enter last name',
            'email.required'  => 'Please enter email address',
            'email.unique'  => 'The email is already in use on the system. Please use a different email.',
            'password.regex' => 'The :attribute field must have: a minimum of 1 lower case letter [a-z] and a minimum of 1 upper case letter [A-Z] and a minimum of 1 numeric character [0-9] and a minimum of 1 special character: ~`!@#$%^&*()-_+={}[]|\;:"<>,./?',
            'website_slug.required'  => 'Please enter Custom URL address',
            'website_slug.unique'  => 'The Custom URL is already in use on the system. Please use a different URL.',
            'aggrement.required'  => 'Please agree to the Terms & Conditions.',
         );
        return Validator::make($data, $rules, $customMessages);
        /*return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $role_id = 2;
        $status = '1';

        $fname = $data['fname'];
        $mname = $data['mname'];
        $lname = $data['lname'];
        $name = trim($fname.' '.$mname);
        $name = trim($name.' '.$lname);

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
        // $user->last_activity = date('Y-m-d H:i:s');
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
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);*/
    }

    public function register(Request $request)
    {
        /*$validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }*/
        $this->validator($request->all())->validate();

        Auth::login($this->create($request->all()));    
        // Now you can redirect!
        /*$page = Page::where('page_template',2)->where('status','1')->first();
        if ($page) {
            return Redirect::to($page->slug);
        }*/
    }
}
