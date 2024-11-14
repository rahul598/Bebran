<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use App\Models\Emailtemplate;
use App\Models\JobProposal;
use App\Models\Country;
use App\Models\MessageConnection;
use App\Models\Notification;
use App\Models\JobView;
use Exception;

trait HelperTrait
{

    public function checkAndMakeConnection($code, $current_user_id, $has_new_connection = null)
    {
        $checkConnection = MessageConnection::where(['connection_code' => $code, ['status', '<>', '3']])->first();
        if (empty($checkConnection)) :
            if (!empty($has_new_connection)) {
                $checkConnection = MessageConnection::create([
                    'from_user_id' => $current_user_id,
                    'to_user_id' => $has_new_connection,
                    'connection_code' => $code,
                    'message' => 'Hi',
                    'status' => '1',
                ]);
            } else {
                $bid = JobProposal::where('code', $code)->first();
                if (!empty($bid)) {
                    $checkConnection = MessageConnection::create([
                        'from_user_id' => $current_user_id,
                        'to_user_id' => $bid->user_id,
                        'connection_code' => $code,
                        'message' => 'Hi',
                        'status' => '1',
                    ]);
                }
            }

        endif;
        return $checkConnection;
    }

    public function SendMailBySwiftMailer($data)
    {
        $data['body_content'] = $data['body'];
        $data['content'] = view('layouts.email', $data)->render();
        dispatch(new SendMailJob($data));
    }

    public function get_email_data($slug, $replacedata = array())
    {
        $email_data = Emailtemplate::where(['id' => 1])->first();
        $_email_content = $email_data->{$slug};
        $replacedata['Sitename'] = config('site.title');
        $email_msg = "";
        $email_array = array();
        $email_msg = $_email_content;
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {
                $email_msg = str_replace("{#" . $key . "#}", $value, $email_msg);
            }
        }
        return $email_msg;
    }




    public function convertCurrency($amount, $to_currency, $from_currency = 'USD')
    {
        $from_currency = strtoupper($from_currency);
        $to_currency = strtoupper($to_currency);
        if (strcmp($from_currency, $to_currency) === 0) {
            return [
                'amount' => $amount,
                'currency' => $from_currency,
            ];
        }
        try {
            $result = Currency::convert()
                ->from($from_currency)
                ->to($to_currency)
                ->amount($amount)
                ->round(2)
                ->date(date('Y-m-d'))
                ->get();
            return [
                'amount' => $result,
                'currency' => $to_currency,
            ];
        } catch (Exception $ex) {
            return [
                'amount' => $amount,
                'currency' => $from_currency,
            ];
        }
    }

    public function purchaseCreditOptions()
    {
        $user_currency = 'USD';
        if (!empty(auth()->user()->country)) {
            $user_country = JpCountry::find(auth()->user()->country);
            $user_currency = $user_country->currency ?? $user_currency;
        }
        $convert_amount_array = $this->convertCurrency(1, $user_currency);
        $convert_amount = $convert_amount_array['amount'];
        $convert_currency = $convert_amount_array['currency'];
        return [
            '1' => [
                'amount' => '25',
                'convert_amount' => $convert_currency . ' ' . number_format(($convert_amount * 25), 2),
                'total_credit' => '50'
            ],
            '2' => [
                'amount' => '50',
                'convert_amount' => $convert_currency . ' ' . number_format(($convert_amount * 50), 2),
                'total_credit' => '100'
            ],
            '3' => [
                'amount' => '150',
                'convert_amount' => $convert_currency . ' ' . number_format(($convert_amount * 150), 2),
                'total_credit' => '300'
            ],
            '4' => [
                'amount' => '250',
                'convert_amount' => $convert_currency . ' ' . number_format(($convert_amount * 250), 2),
                'total_credit' => '500'
            ],
            '5' => [
                'amount' => '500',
                'convert_amount' => $convert_currency . ' ' . number_format(($convert_amount * 500), 2),
                'total_credit' => '1000'
            ],

        ];
    }


    public function drawMembershipPricingChart($user_currency, $id = NULL)
    {
        $data['plans'] = [];

        $plans_sql = Membership::where(['status' => '1']);
        if (!empty($id)) {
            $plans_sql->where('id', $id);
        }
        $plans = $plans_sql->oldest('rank')->get();
        $used_trail = UserSubscriptionPlan::where('user_id',auth()->user()->id)->first();
        if (sizeof($plans) > 0) {
            foreach ($plans as $i => $plan) {

                if (!empty($plan->monthly_price)) {
                    $save_amount = 0;
                    $usd_save_amount = 0;
                    $convert_amount_array = $this->convertCurrency($plan->monthly_price, $user_currency);
                    $original_amount = $convert_amount_array['amount'];
                    // if (!empty($plan->monthly_save)) {
                    //     $save_amount = ($original_amount * $plan->monthly_save) / 100;
                    //     $usd_save_amount = ($plan->monthly_price * $plan->monthly_save) / 100;
                    // }
                    $trail_begin_date = date('Y-m-d H:i:s');
                    if ($used_trail) {
                        //$trail_end_date = $trail_begin_date;
                        $trail_end_date = date('Y-m-d H:i:s', strtotime($trail_begin_date. ' + 1 month'));
                    }else{
                        $trail_end_date = date('Y-m-d H:i:s', strtotime($trail_begin_date. ' + '.$plan->trial_day.' days'));
                    }
                    
                    $data['plans']['monthly'][$i] = (object) [
                        'id' => $plan->id,
                        'name' => $plan->name,
                        'body' => $plan->body,
                        'total_active_job_monthly' => $plan->total_active_job_monthly,
                        'total_active_job_quarterly' => $plan->total_active_job_quarterly,
                        'total_active_job_half_yearly' => $plan->total_active_job_half_yearly,
                        'trial_day' => $plan->trial_day,
                        'trail_begin_date' => $trail_begin_date,
                        'trail_end_date' => $trail_end_date,
                        'cycle' => 'month',
                        'usd_amount' => $plan->monthly_price,
                        'usd_save_amount' => $usd_save_amount,
                        'save_percentage' => $plan->monthly_save,
                        'original_amount' => $original_amount,
                        'save_amount' => number_format(($original_amount * $plan->monthly_save) / 100, 2),
                        'pay_amount' => ($original_amount - $save_amount),
                        'pay_usd_amount' => ($plan->monthly_price - $usd_save_amount),
                        'currency' => $convert_amount_array['currency'],
                    ];
                }
                if (!empty($plan->quarterly_price)) {
                    $save_amount = 0;
                    $usd_save_amount = 0;
                    $convert_amount_array = $this->convertCurrency($plan->quarterly_price, $user_currency);
                    $original_amount = $convert_amount_array['amount'];
                    // if (!empty($plan->quarterly_save)) {
                    //     $save_amount = ($original_amount * $plan->quarterly_save) / 100;
                    //     $usd_save_amount = ($plan->quarterly_price * $plan->quarterly_save) / 100;
                    // }
                    $trail_begin_date = date('Y-m-d H:i:s');
                    if ($used_trail) {
                        //$trail_end_date = $trail_begin_date;
                        $trail_end_date = date('Y-m-d H:i:s', strtotime($trail_begin_date. ' + 3 month'));
                    }else{
                        $trail_end_date = date('Y-m-d H:i:s', strtotime($trail_begin_date. ' + '.$plan->trial_day.' days'));
                    }

                    $data['plans']['quarterly'][$i] = (object)[
                        'id' => $plan->id,
                        'name' => $plan->name,
                        'body' => $plan->body,
                        'total_active_job_monthly' => $plan->total_active_job_monthly,
                        'total_active_job_quarterly' => $plan->total_active_job_quarterly,
                        'total_active_job_half_yearly' => $plan->total_active_job_half_yearly,
                        'cycle' => '3 month',
                        'trial_day' => $plan->trial_day,
                        'trail_begin_date' => $trail_begin_date,
                        'trail_end_date' => $trail_end_date,
                        'usd_amount' => $plan->quarterly_price,
                        'usd_save_amount' => $usd_save_amount,
                        'save_percentage' => $plan->quarterly_save,
                        'original_amount' => $original_amount,
                        'save_amount' => number_format(($original_amount * $plan->quarterly_save) / 100, 2),
                        'pay_amount' => ($original_amount - $save_amount),
                        'pay_usd_amount' => ($plan->quarterly_price - $usd_save_amount),
                        'currency' => $convert_amount_array['currency'],
                    ];
                }
                if (!empty($plan->half_yearly_price)) {
                    $save_amount = 0;
                    $usd_save_amount = 0;
                    $convert_amount_array = $this->convertCurrency($plan->half_yearly_price, $user_currency);
                    $original_amount = $convert_amount_array['amount'];
                    // if (!empty($plan->half_yearly_save)) {
                    //     $save_amount = ($original_amount * $plan->half_yearly_save) / 100;
                    //     $usd_save_amount = ($plan->half_yearly_price * $plan->half_yearly_save) / 100;
                    // }
                    $trail_begin_date = date('Y-m-d H:i:s');
                    if ($used_trail) {
                        //$trail_end_date = $trail_begin_date;
                        $trail_end_date = date('Y-m-d H:i:s', strtotime($trail_begin_date. ' + 6 month'));
                    }else{
                        $trail_end_date = date('Y-m-d H:i:s', strtotime($trail_begin_date. ' + '.$plan->trial_day.' days'));
                    }
                    
                    $data['plans']['half_yearly'][$i] = (object)[
                        'id' => $plan->id,
                        'name' => $plan->name,
                        'body' => $plan->body,
                        'total_active_job_monthly' => $plan->total_active_job_monthly,
                        'total_active_job_quarterly' => $plan->total_active_job_quarterly,
                        'total_active_job_half_yearly' => $plan->total_active_job_half_yearly,
                        'cycle' => 'half yearly',
                        'trial_day' => $plan->trial_day,
                        'trail_begin_date' => $trail_begin_date,
                        'trail_end_date' => $trail_end_date,
                        'usd_amount' => $plan->half_yearly_price,
                        'usd_save_amount' => $usd_save_amount,
                        'save_percentage' => $plan->half_yearly_save,
                        'original_amount' => $original_amount,
                        'save_amount' => number_format(($original_amount * $plan->half_yearly_save) / 100, 2),
                        'pay_amount' => ($original_amount - $save_amount),
                        'pay_usd_amount' => ($plan->half_yearly_price - $usd_save_amount),
                        'currency' => $convert_amount_array['currency'],
                    ];
                }
            }
        }

        return $data['plans'];
    }

    public function storeUserProfileView($profile_id)
    {
        $user_id = auth()->user()->id;
        $ip_address = request()->ip();
        $job_view = ProfileView::firstWhere(['profile_id' => $profile_id, 'user_id' => $user_id]);
        if (!empty($job_view)) {
            $job_view->update([
                'no_of_view' => $job_view->no_of_view + 1,
                'ip_address' => $ip_address,
            ]);
        } else {
            ProfileView::create([
                'profile_id' => $profile_id,
                'user_id' => $user_id,
                'no_of_view' => 1,
                'ip_address' => $ip_address,
            ]);
        }
    }

    public static function lastNotificationID()
    {
        $model = Notification::select('id')->orderBy('id', 'desc')->first();
        if (!empty($model)) {
            return ($model->id + 1);
        }
        return 1;
    }

    public static function makeNotification($data)
    {
        Notification::create($data);
    }

    public static function makeAsINACTIVE()
    {
        $models = Notification::where(['notifier_id' => auth()->user()->id, 'is_view' => '0', 'status' => '1'])->get();
        if (sizeof($models) > 0) {
            foreach ($models as $model) {
                $model->update(['is_view' => '1', 'status' => '3']);
            }
        }
    }
}