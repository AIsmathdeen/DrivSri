<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\LicenseHolder;
use App\Models\Offense;
use App\Models\User;
use App\Models\RequestCerification;
use App\Models\LicenseStatus;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;

class LicenseHolderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $license_holder = LicenseHolder::where('user_id', $user_id)->first();
        $offences = Offense::where('license_holder_id', $license_holder->id)->get();

        $total_fine_amount = 0;
        // calculating the accumulated total fine amount
        foreach ($offences as $offence)
        {
            $total_fine_amount = $total_fine_amount + $offence->total_fine_amount;
        }
        return view('license_holder.license_holder', ['user' => $license_holder, 'fine_amount' => $total_fine_amount]);
    }

    public function showAllOffences()
    {
        $user_id = Auth::user()->id;
        //dd($user_id);
        $license_holder = LicenseHolder::where('user_id', $user_id)->first();
        $offences = Offense::where('license_holder_id', $license_holder->id)->get();
       // dd($offences);

        return view('license_holder.offences.view_offences', ['offences' => $offences]);
    }

    public function viewOffence($id)
    {
        //dd($id);
        $offence = Offense::where('id', $id)->first();
        ///  dd($offence);
        return view('license_holder.offences.view_single_offence', ['offence' => $offence]);
    }

    public function updatePaymentStatus(Request $request)
    {
        $merchant_id         = $request->input('merchant_id');
        $order_id             = $request->input('order_id');
        $payhere_amount     = $request->input('payhere_amount');
        $payhere_currency    = $request->input('payhere_currency');
        $status_code         = $request->input('status_code');
        $md5sig                = $request->input('md5sig');

        $merchant_secret = '4JIP66MS4ZQ8LM2QDoAqOK4uR4BUZbxgP48VIdZHDygF'; // Payhere Merchant Secret number

        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));
        $user = Auth::user();
        $license_holder = LicenseHolder::where('user_id', $user->id)->first();
        if (($local_md5sig === $md5sig) and ($status_code == 2)) {
            $offence = Offense::where('id', $order_id)->first();
            $offence->payment_status = 3;
            $offence->save();
        }
    }

    public function showUpdateProfile()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $license_holder = LicenseHolder::where('user_id', $userId)->first();
        // dd($userId);
        return view('license_holder.update_profile.update', ['user' => $user, 'license_holder' => $license_holder]);
    }

    public function updateLicenseHolder(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);
        $mobile_number= str_replace(' ','',$request->input('mobile_number'));


        $license_holder = LicenseHolder::where('user_id', Auth::user()->id)->first();

        //dd($license_holder);
        $user->email = $request->input('email');
        $license_holder->first_name = $request->input('first_name');
        $license_holder->last_name = $request->input('last_name');
        $license_holder->mobile_no = $mobile_number;
        $license_holder->dob = $request->input('dob');
        $license_holder->postal_address = $request->input('address');
        $license_holder->license_no = $request->input('license_no');

        $user->save();
        $license_holder->save();
        return redirect('licensed_holder/update_profile')->with('status', 'Profile Updated Succesfully');
    }
    public function showFineList()
    {
        $fines =Fine::all();
        return view('license_holder.fines.view_fine_list', ['fines' => $fines]);
    }

    public function showcertificatedetails()
    {

        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $license_holder = LicenseHolder::where('user_id', $userId)->first();
        //dd($license_holder);
        return view('license_holder.certification.add_certification', ['user' => $user, 'license_holders' => $license_holder]);
    }

    public function Viewcertificate($id)
    {
        //dd($id);
       
        $license_holder = LicenseHolder::where('user_id', $id)->first();
        //dd($license_holder);

        $request_certificate = RequestCerification::where('license_holder_id', $license_holder->id)->first();
        //dd($request_certificate);

        if ($request_certificate != null) {
            // dump("cant added exist lh");
            return redirect('/licensed_holder/add_certificate')->with('status', 'you have already requested certificated');
        } else {
            $new_request_certificates = new RequestCerification();
            $new_request_certificates->license_holder_id = $license_holder->id;
            // dd($license_holder->id);

            $new_request_certificates->save();
            return redirect('/licensed_holder/add_certificate')->with('status2', 'successfully requested certificate.');
        }
        //   dd($license_holder->id);

    }
}
