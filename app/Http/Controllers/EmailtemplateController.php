<?php
namespace App\Http\Controllers;
use Redirect;
//use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Emailtemplate;
use Illuminate\Support\Facades\DB;

class EmailtemplateController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth','verified']);
	}

	public function emailtemplate()
	{
		$emailtemplate = Emailtemplate::where('id', '1')->first();
		return view('admin.emailtemplate', compact('emailtemplate'));
	}


	public function update(Request $request)
	{
		$rules = array(
			'registration_email' => 'required',
			'forgotpass_email' => 'required',
			'password_change_email' => 'required',
			// 'order_email' => 'required',
			// 'order_email_to_admin' => 'required',
			// 'job_proposal_alert' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('email-template')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				DB::beginTransaction();
				// store
					$updateObj = Emailtemplate::find(1);
					if ($request->registration_email) {
						$updateObj->registration_email = $request->registration_email;
					}
					if ($request->forgotpass_email) {
						$updateObj->forgotpass_email = $request->forgotpass_email;
					}
					if ($request->password_change_email) {
						$updateObj->password_change_email = $request->password_change_email;
					}
					if ($request->verify_email) {
						$updateObj->verify_email = $request->verify_email;
					}
					// $updateObj->order_email = $request->order_email;
					// $updateObj->order_email_to_admin = $request->order_email_to_admin;
					// $updateObj->order_cancel_email = $request->order_cancel_email;
					// $updateObj->job_proposal_alert = $request->job_proposal_alert;
					$updateObj->save();
				DB::commit();

				return redirect()->back()->with('success', 'Email Template has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}
}