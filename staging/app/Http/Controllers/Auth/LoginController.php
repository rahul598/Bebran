<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Redirect;
use Session;
use Auth;
use App\Models\Page;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->redirectTo = url(get_field_value('pages','slug','page_template',2));
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status != 1) {

            if($user->status==0)
            {
                $message = 'Your account is inactive, please contact to administratior.';
            }
            else
            {
                $message = 'Your account has been deleted.';
            }

            // Log the user out.
            $this->logout($request);

            // Return them to the log in form.
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    // This is where we are providing the error message.
                    'email' => $message,
                ]);
        }
        else
        {
            //DB::table('users')->where('id', $user->id)->update(['already_logged' => 1, 'last_login'=>date('Y-m-d H:i:s')]);
        }
        // $page = Page::where('page_template',2)->where('status','1')->first();
        // if ($page) {
        //     if (url()->previous()==url('/dashboard')) {
        //         //return Redirect::to($page->slug);
        //     }
        //     dd(url()->previous());
        // }
    }


    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function logout(Request $request)
    {
        // Auth::user()->update(['already_logged' => 0]);
        $user = Auth::user();
        $user->already_logged = 0;
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
