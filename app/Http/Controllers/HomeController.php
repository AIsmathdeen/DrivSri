<?php

namespace App\Http\Controllers;

use App\Models\LicenseHolder;
use App\Models\Offense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\paymentnotify;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function payhereNotify(Request $request)
    {
        Log::info($request->all());
        $status_code = $request->input('status_code');
        // dd($status_code);


        if ($status_code === '2') {

            $offense_id = $request->input('order_id');
            $payment_id = $request->input('payment_id');
            $paid_amount = $request->input('payhere_amount');
            $status_message = $request->input('status_message');

            $offence =  Offense::where('id', $offense_id)->first();

            $remaining_fine_amount = $offence->total_fine_amount - $paid_amount;
            $offence->payment_status=2;
            $offence->total_fine_amount = $remaining_fine_amount;
            $offence->save();

            $license_holder_email = $offence->licensedHolder->user->email;
            $license_holder_name = $offence->licensedHolder->first_name;
            $license_holder_total_demerit_points = $offence->licensedHolder->total_demerit_points;
            $license_holder_id = $offence->license_holder_id;

            $remaing_unpaid_offences = Offense::where('license_holder_id', $license_holder_id)
                                     ->where('payment_status', 1)
                                     ->orWhere('payment_status', 2)->get()->toArray();

            Log::info("message",$remaing_unpaid_offences);
            if (empty($remaing_unpaid_offences)) {
                if ($license_holder_total_demerit_points <= 30) {
                    $license_holder =  LicenseHolder::find($license_holder_id);
                    $license_holder->status_id = 1;
                    $license_holder->save();
                }
            }
        }

        $payment_details = array(
            'payment_id' => $payment_id,
            'paid_amount' => $paid_amount,
            'status_message' => $status_message,
            'license_holder_name' => $license_holder_name,
        );

        Mail::to($license_holder_email)->send(new paymentnotify($payment_details));
    }
}
