<?php

namespace App\Http\Controllers;

use App\Models\LicenseHolder;
use Illuminate\Http\Request;
use App\Models\Policeman;
use App\Models\Vehicle_class;
use App\Models\PaymentStatus;
use App\Models\Fine;
use App\Models\OffenceHasFine;
use App\Models\Offense;
use App\Models\Police_division;
use Illuminate\Support\Facades\Auth;
use Nexmo\Laravel\Facade\Nexmo;
use App\Mail\sendmail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class PoliceController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        // dd($id);
        $policemen = Policeman::where('user_id', $id)->first();

        $offences = Offense::where('policeman_id', $policemen->id)->get();
        $total_offences_amounts = 0;
        //  DB::table('offenses')
        //     ->select(DB::raw('count(id) as offences_amount'))
        //     ->groupBy('policeman_id')
        //     ->where('policeman_id', $policemen->id)
        //     ->first();

          foreach ($offences as $offence)
            {
                $total_offences_amounts = $total_offences_amounts + 1;
            }

        return view('police.police', ['total_offences_amount' => $total_offences_amounts, 'user' => $policemen]);
    }

    public function showLicenHolders()
    {
        $license_holder = LicenseHolder::all();
        return view('police.license_holder.view_license_holders', ['license_holders' => $license_holder]);
    }

    public function showLicenHolderDetails()
    {
        return view('police.license_holder.view_license_holder_details');
    }


    public function showAddOffences()
    {
        $id = Auth::id();
        // dd($id);
        $license_holder = LicenseHolder::all();
        $policemen = Policeman::where('user_id', $id)->first();
        // dd($policemen);
        $vehicle_class = Vehicle_class::all();
        $payment_status = PaymentStatus::all();
        $fines = Fine::all();

        return view('police.offences.add_offence', [
            'license_holders' => $license_holder, 'policemens' => $policemen,
            'vehicle_class' => $vehicle_class, 'payment_status' => $payment_status, 'fines' => $fines
        ]);
    }
    public function calculateAmount(Request $request)
    {
        $fines = $request->input('fines');
        $fine_collection = explode(',', $fines);

        $final_amount = 0;
        $demerit = 0;
        if ($fines !== null) {
            foreach ($fine_collection as $key => $fine_id) {
                $fine = Fine::where('id', $fine_id)->first();

                $final_amount = $final_amount +  $fine->fine_amount;
                $demerit = $demerit + $fine->demerit_points;
            }
        } else {
            $final_amount = "";
            $demerit = "";
        }

        $res['success'] = true;
        $res['final_amount'] = $final_amount;
        $res['demerit'] = $demerit;
        return response($res);
    }

    public function saveOffence(Request $request, $policemen_id)
    {

        // $request->validate([
        //     'payment_date'=>['required'],
        //     'ine_issued_date'=>['required']
        // ]);

        //$policeman_id = $request->input('policemen_id');
        $license_holder_id = $request->input('license_holder_id');
        $vehicle_class_id = $request->input('vehicle_class_id');
        $issue_date = $request->input('issue_date');
        $payment_date = $request->input('payment_date');
        $fines = $request->input('fines'); $demerit_points = $request->input('demerit_points');
        $fine_amount = $request->input('fine_amount');

        $license_holder = LicenseHolder::where('id', $license_holder_id)->first();
        $user_demerit =$license_holder->total_demerit_points;


        // dd($user_demerit);
        if ($user_demerit<24) {
            $offence = new Offense();
            $user_demerit = $user_demerit + $demerit_points;
            $offence->license_holder_id = $license_holder_id;
            $offence->policeman_id = $policemen_id;
            $offence->vehicle_class_id = $vehicle_class_id;
            $offence->fine_issued_date = $issue_date;
            $offence->payment_status = 1;
            $offence->payment_date = $payment_date;
            $offence->total_fine_amount = $fine_amount;
            $offence->total_demerit_points = $demerit_points;
            //    dd( $offence);
            $offence->save();

            $license_holder->total_demerit_points = $user_demerit;
            $license_holder->last_fine_issued_date=$issue_date;
            $license_holder->save();

            $offence_id = $offence->id;

            foreach ($fines as $key => $fine_id) {
                $has_fine = new OffenceHasFine();
                $has_fine->offences_id = $offence_id;
                $has_fine->fine_id = $fine_id;
                $has_fine->save();
            }

            if ($user_demerit>= 24 && $user_demerit <28 ) {
                $license_holder->status_id =2;
                $license_holder->save();
            }
            else if ($user_demerit>= 28) {
                $license_holder->status_id =3;
                $license_holder->save();
            }
            $data = [
                'name' => $license_holder->first_name,
                'email' => $license_holder->user->email,
                'issue_date' => $issue_date,
                'payment_date' =>  $payment_date,
                'fine_amount' => $fine_amount,
                'demerit_points' => $demerit_points,
                'total_demerit_points' => $user_demerit
            ];
            try {
                Mail::to($data['email'])->send(new sendmail($data));
                // Log::error($data);
            } catch (Exception $ex) {
                Log::error($ex);
            }

            return redirect('policemen/view_add_offences')->with('status', 'Spot Fine is issued Successfully!');
        }
        else {
            $license_holder->status_id = 2;
            $license_holder->save();
            return redirect('policemen/view_add_offences')->with('status-failed', 'Driving Licence Holder is Suspended! ');
            // dd("Email is Sent.");
        }
    }

    public function showOffencesList()
    {
        $policemen_id = Auth::id();

        $police =Policeman::where('user_id', '=',$policemen_id)->first();
        $offence = Offense::where('policeman_id',$police->id)->get();
        return view('police.offences.view_offences_list', ['offence' => $offence]);
    }

    public function showUpdateProfile()
    {
        $id = Auth::user()->id;
        $policemen = Policeman::where('user_id', '=', $id)->first();
        // dd($policemen);
        $division = Police_division::all();
        return view('police.update_profile', ['policemen' => $policemen, 'divisions' => $division]);
    }

    public function updateProfile(Request $request, $id)
    {

        $mobile_number= str_replace(' ','',$request->input('mobile_number'));
        $policemen = Policeman::find($id);

        $policemen->first_name = $request->input('first_name');
        $policemen->last_name = $request->input('last_name');
        $policemen->mobile_number = $mobile_number;
        $policemen->postal_address = $request->input('address');
        $policemen->dob = $request->input('dob');

        $policemen->save();
        // $total_offences_amounts = DB::table('offenses')
        //     ->select(DB::raw('count(id) as offences_amount'))
        //     ->groupBy('policeman_id')
        //     ->where('policeman_id', $policemen->id)
        //     ->first();

        return redirect()->back()->with('status','Policemen Updated Successfully');
    }

    public function findLicenseHolderName(Request $request)
    {
        $license_holder_id = $request->input('license_holder_id');
        $license_holder = LicenseHolder::find($license_holder_id);

        $res['success'] = true;
        $res['name'] = $license_holder->first_name . " " . $license_holder->last_name;
        $res['mobile_no'] = $license_holder->mobile_no;
        return response($res);
    }
}
