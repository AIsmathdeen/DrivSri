<?php

namespace App\Http\Controllers;


use App\Enums\RoleType;
use App\Models\LicenseHolder;
use App\Models\Policeman;
use App\Models\User;
use App\Enums\LicenseStatusType;
use App\Models\Fine;
use App\Models\LicenseStatus;
use App\Models\OffenceHasFine;
use App\Models\Offense;
use App\Models\PaymentStatus;
use App\Models\Police_division;
use App\Models\Vehicle_class;
use CreateOffencesHasFinesTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use Illuminate\Support\Facades\DB;
use App\Models\RequestCerification;
use Illuminate\Support\Facades\Auth;
use App\Mail\certificatenotify;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Password;


class AdminController extends Controller
{

    //------> LICENSE HOLDERS

    public function index()
    {
        $license_holders_count = DB::table('license_holders')
            ->select(DB::raw('count(id) as license_holders_counts'))
            ->first();
        //dd($license_holders_count);

        $police_officers_count = DB::table('policemen')
            ->select(DB::raw('count(id) as police_officers_counts'))
            ->first();
        //dd($police_officers_count);

        $total_offences_count = DB::table('offenses')
            ->select(DB::raw('count(id) as total_offences_counts'))
            ->first();
        //dd($total_offences_count);


        return view('admin.admin', ['license_holders' => $license_holders_count, 'police_officers' => $police_officers_count, 'offences_count' => $total_offences_count]);

    }

    //REQUESTS
    public function storeLicenseHolder(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'max:255','Unique:users'],
            'license_no' => ['required', 'string', 'max:255','Unique:license_holders']
        ]);

        $user = new User();
        $user->email = $request->input('email');
        //dd($user->email);
        // $user->password = Hash::make($request->input('password'));

        $user->save();
        $user->refresh();
        Password::sendResetLink($request->only(['email']));
        $user->assignRole(RoleType::LICENSE_HOLDER);
        $status = LicenseStatus::where('type', LicenseStatusType::ACTIVE)->first();
        //dd($status);
        // dd($user->id)



        $licenseHolder = new LicenseHolder();
        $mobile_number= str_replace(' ','',$request->input('mobile_number'));
        $licenseHolder->first_name = $request->input('first_name');
        $licenseHolder->last_name = $request->input('last_name');
        $licenseHolder->mobile_no = $mobile_number;
        $licenseHolder->dob = $request->input('dob');
        $licenseHolder->postal_address = $request->input('address');
        $licenseHolder->license_no = $request->input('license_no');
        $licenseHolder->status_id = $status->id;
        $licenseHolder->expiry_date = $request->input('expiry_date');
        $licenseHolder->user_id = $user->id;
        $licenseHolder->save();

        return redirect('admin/view_license_holders')->with('status', 'License Holder Added!');
    }

    public function destroyLicenseHolder($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        $license_holder = LicenseHolder::where('user_id', $user_id)->first();
        $license_holder ->delete();
        return redirect('/admin/view_license_holders')->with('status', 'Lisence holder has been deleted');
    }
    public function restoreLicenseHolder($user_id)
    {
        User::withTrashed()->findOrFail($user_id)->restore();
        LicenseHolder::withTrashed()->where('user_id', $user_id)->first()->restore();
        return back()->with('status', 'Lisence holder has been restored');

    }
    public function viewLicensedHolders(Request $request)
    {
        $license_holders = LicenseHolder::with('licenseStatus')->latest()->get();
        //dd($license_holders);
        //dd($status);
        if($request->has('view_deleted'))
        {
            $license_holders = LicenseHolder::onlyTrashed()->with('licenseStatus')->latest()->get();

        }
        return view('admin.license_holders.view_license_holders', ['license_holders' => $license_holders]);
    }

    public function viewLicenseHolder($user_id)
    {

        $license_holder = LicenseHolder::where('user_id', $user_id)->first();
        // $license_status = LicenseStatus::where('id', $license_holder->status_id)->first();
        return view('admin.license_holders.view_license_holder', ['license_holder' => $license_holder]);
        // $license_holders = LicenseHolder::latest()->get();
    }

    public function editLicensedHolder(Request $request, $user_id)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'license_no' => ['required', 'string', 'max:20'],
            'expiry_date' => ['required', 'date'],

        ]);


        $user = User::findOrFail($user_id);
        $license_holder = LicenseHolder::where('user_id', $user->id)->first();
        $license_holder->first_name = request('first_name');
        $license_holder->last_name = request('last_name');
        $license_holder->dob = request('dob');
        $license_holder->postal_address = request('address');
        $license_holder->license_no = request('license_no');
        $license_holder->expiry_date = request('expiry_date');
        $license_holder->status_id = request('license_status_id');
        $license_holder->save();

        return redirect('admin/view_license_holders')->with('status', 'Updated Successfully!');
    }


    //VIEWS
    public function addLicenseHolders()
    {
        return view('admin.license_holders.add_license_holders');
    }

    public function viewupdateLicenseHolders($user_id)
    {
        $user = User::findOrFail($user_id);
        $license_holder = LicenseHolder::where('user_id', $user_id)->first();
        $license_status = LicenseStatus::get();
        // dd($license_holder);
        return view('admin.license_holders.update_license_holders', ['license_holder' => $license_holder, 'users' => $user, 'license_status' => $license_status]);
    }
    public function viewCertificateList()
    {

        $certificate_details = RequestCerification::get();

        return view('admin.license_holders.view_certificate_list', ['certificates' => $certificate_details]);
    }

    public function sendCertifacate($id)
    {
        $license_holder = LicenseHolder::find($id);
        $user_email = $license_holder->user->email;
        $demerit_points =  $license_holder->total_demerit_points;

        if ($demerit_points>= 5) {
            return redirect('/admin/view_certificate_list')->with('status2', 'Cannot Issue Certification');
        }
        else
        {

            $request_certificate = RequestCerification::where('license_holder_id', $license_holder->id)->first();
            if ($request_certificate != null) {
                 return redirect('/admin/view_certificate_list')->with('status', 'certificate has been already issued.');
            }
        else{
                $certificate = array(
                  'name' => $license_holder->first_name,
                  'license_number' => $license_holder->license_no
                );

                Mail::to($user_email)->send(new certificatenotify($certificate));

                return redirect('/admin/view_certificate_list')->with('status', 'Certification is sent Successfully!');

             }

        }
    }


    //------> POLICE OFFICERS

    //REQUESTS
    public function storePoliceOfficer(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'postal_address' => ['required', 'string', 'max:255'],
            'registration_number' => ['required', 'string', 'max:20','unique:policemen'],
        ]);

        //dd($request->all());
        $user = new User();

        $user->email = $request->input('email');
        //$user->password = Hash::make($request->input('password'));

        $user->save();
        $user->refresh();
        Password::sendResetLink($request->only(['email']));
        $user->assignRole(RoleType::POLICEMAN);


        $policeOfficer = new Policeman();

        $policeOfficer->first_name = $request->input('first_name');
        $policeOfficer->last_name = $request->input('last_name');
        $policeOfficer->mobile_number = $request->input('mobile_number');

        $policeOfficer->dob = $request->input('dob');
        $policeOfficer->postal_address = $request->input('postal_address');
        $policeOfficer->registration_number = $request->input('registration_number');
        $policeOfficer->division_id = $request->input('police_division_id');
        $policeOfficer->user_id = $user->id;


        $policeOfficer->save();

        return redirect('admin/view_police_officers')->with('status', 'Police Officer Added!');
    }

    public function destroyPoliceOfficer($user_id)
    {

        $user = User::findOrFail($user_id);
        $user->delete();
        $police_officer = Policeman::where('user_id', $user_id)->first();
        $police_officer->delete();
        return redirect('/admin/view_police_officers')->with('status', 'Police Officer Deleted!');
    }

    public function restorePoliceOfficers($user_id)
    {
        User::withTrashed()->findOrFail($user_id)->restore();
        Policeman::withTrashed()->where('user_id', $user_id)->first()->restore();
        return back()->with('status', 'Police Officer has been restored');
    }

    public function editPoliceOfficer(Request $request, $id)
    {

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'registration_number' => ['required', 'string', 'max:20'],
        ]);


        //  $user = User::findOrFail($id);
        $police_officer = Policeman::where('id', $id)->first();
        //dd( $police_officer->first_name);
        $police_officer->first_name = request('first_name');
        $police_officer->last_name = request('last_name');
        $police_officer->dob = request('dob');
        $police_officer->postal_address = request('address');
        $police_officer->registration_number = request('registration_number');
        $police_officer->division_id =request('police_division_id');
        $police_officer->save();

        return redirect('/admin/view_police_officers')->with('status', 'Police Officer Updated Successfully!');
    }


    //VIEWS

    public function viewPoliceOfficers(Request $request)
    {
        $police_officers = Policeman::all();
        // dd($police_officers);
        if($request->has('view_deleted'))
        {
            $police_officers = Policeman::onlyTrashed()->latest()->get();

        }
        return view('admin.police_officers.view_police_officers', ['police_officers' => $police_officers]);
    }

    public function viewPoliceOfficer($user_id)
    {

        $police_officer = Policeman::where('user_id', $user_id)->first();
        // $license_status = LicenseStatus::where('id', $police_officer->status_id)->first();
        return view('admin.police_officers.view_police_officer', ['police_officer' => $police_officer]);
        // $police_officers = Policeman::latest()->get();
    }

    public function addPoliceOfficers()
    {
        $police_divition = Police_division::all();
        //dd($police_divition);
        return view('admin.police_officers.add_police_officers', ['police_devision' => $police_divition]);
    }

    public function updatePoliceOfficers($id)
    {
        // dd($id);
        // $user = User::findOrFail($id);
        $police_officer = Policeman::where('id', $id)->first();
        $police_division = Police_division::get();
        // dd($police_division->id);
        //  dd( $police_officer);
        return view('admin.police_officers.update_police_officers', ['police_officer' => $police_officer, 'police_divisions' => $police_division]);
    }


    //------> FINES

    //REQUESTS
    public function storeFine(Request $request)
    {

        $request->validate([
            'fine_amount' => ['required', 'integer'],
            'demerit_points' => ['required', 'integer', 'max:255'],
            'provision'=>['required', 'string'],
            'section_of_act'=>['required', 'string', 'max:255','unique:fines']
        ]);

        $fine = new Fine();
        $fine->fine_amount = $request->input('fine_amount');
        $fine->demerit_points = $request->input('demerit_points');
        $fine->provision = $request->input('provision');
        $fine->section_of_act = $request->input('section_of_act');

        //dd($fine);
        $fine->save();
        return redirect('admin/view_fines')->with('status', 'Fine Added!');
    }
    public function showUpdateFine($id)
    {
        $fine = Fine::find($id);
        //dd($fine);
        return view('admin.fines.update_fine')->with(compact('fine'));
    }

    public function updateFine(Request $request, $id)
    {
        // dd($id);
        $fine = Fine::find($id);

        $fine->provision = $request->input('provision');
        $fine->fine_amount = $request->input('fine_amount');
        $fine->section_of_act = $request->input('section_of_act');
        $fine->demerit_points = $request->input('demerit_point');
        $fine->save();
        return redirect('admin/view_fines')->with('status', 'Fine updated succesfully');
    }

    public function destroyFine($fine_id)
    {
        $fine = Fine::findOrFail($fine_id);
        $fine->delete();
        return redirect('/admin/view_fines')->with('status', 'Fine Deleted!');
    }

    public function showAddFine()
    {
        return view('admin.fines.add_fine');
    }

    public function editFine(Request $request, $fine_id)
    {
        $request->validate([
            'demerit_points' => ['required', 'integer', 'max:255'],
            'fine_amount' => ['required', 'integer'],
            'payment_date' => ['required', 'date', 'max:255'],
        ]);

        $fine = Fine::findOrFail($fine_id);

        $fine->license_holder_id = $request->input('license_holder_id');
        $fine->offense_id = $request->input('offence_id');
        $fine->fine_issued_date = $request->input('fine_issued_date');
        $fine->fine_amount = $request->input('fine_amount');
        $fine->demerit_points = $request->input('demerit_points');
        $fine->vehicle_class_id  = $request->input('vehicle_class_id');
        $fine->policeman_id = $request->input('policeman_id');
        $fine->payment_date = $request->input('payment_date');
        $fine->payment_status = $request->input('payment_status_id');

        $fine->save();

        return redirect('/admin/view_fines')->with('status', 'Updated Successfully!');
    }


    //VIEWS

    public function showOffencesList()
    {
        $offence = Offense::get();
        $fine = Fine::get();
        return view('admin.offences.view_offences_list', ['fines' => $fine,'offences'=>$offence]);
    }

    public function viewFine($fine_id)
    {

        $fine = Fine::where('fine_id', $fine_id)->first();
        // $license_status = LicenseStatus::where('id', $fine->status_id)->first();
        return view('admin.fines.view_fine', ['fine' => $fine]);
        // $fines = Fine::latest()->get();
    }

    public function addFines()
    {
        $license_holder = LicenseHolder::all();
        $offense = Offense::all();
        $vehicle_class = Vehicle_class::all();
        $policemen = Policeman::all();
        $payment_status = PaymentStatus::all();
        // dd($license_holder->first_name);

        return view('admin.fines.add_fines', ['license_holders' => $license_holder, 'offenses' => $offense, 'vehicle_class' => $vehicle_class, 'policemen' => $policemen, 'payment_statuses' => $payment_status]);
    }

    public function updateFines($fine_id)
    {
        $fine = Fine::findOrFail($fine_id);
        $license_holder = LicenseHolder::all();
        $offense = Offense::all();
        $vehicle_class = Vehicle_class::all();
        $policemen = Policeman::all();
        $payment_status = PaymentStatus::all();

        return view('admin.fines.update_fines', ['license_holders' => $license_holder, 'fine' => $fine, 'offenses' => $offense, 'vehicle_class' => $vehicle_class, 'policemen' => $policemen, 'payment_statuses' => $payment_status]);
    }

    public function showFine($fine_id)
    {
        $fine = Fine::findOrFail($fine_id);
        return view('admin.fines.view_fine_single',['fine' => $fine]);

    }


    //---------> OFFENSES
    //REQUESTS


    //VIEWS
    public function showFineList()
    {
        $fines = Fine::all();
        return view('admin.fines.view_fine_list', ['fines' => $fines]);
    }

    public function searchFine()
    {
        $search_text=$_GET['search'];
        $fines = Fine::where('section_of_act','like','%'.$search_text.'%')
                    ->orwhere('provision','like','%'.$search_text.'%')->get();
        return view('admin.fines.view_fine_list', ['fines' => $fines]);

    }

   public function showReminder()
   {
        $offence = Offense::get();
        $fine = Fine::get();
        return view('admin.offences.view_reminder_list', ['fines' => $fine,'offences'=>$offence]);

   }
    public function showAddOffences()
    {
        $license_holder = LicenseHolder::all();
        $policemen = Policeman::all();
        $vehicle_class = Vehicle_class::all();
        $payment_status = PaymentStatus::all();
        $fines = Fine::all();

        return view('admin.offences.add_offence', [
            'license_holders' => $license_holder, 'policemens' => $policemen,
            'vehicle_class' => $vehicle_class, 'payment_status' => $payment_status, 'fines' => $fines
        ]);
    }


    function calculateAmount(Request $request)
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

    public function saveOffences(Request $request)
    {
        $fines = $request->input('fines');
        $policeman_id = $request->input('policemen_id');
        $license_holder_id = $request->input('license_holder_id');
        $vehicle_class_id = $request->input('vehicle_class_id');
        $payment_status_id = $request->input('payment_status_id');
        $payment_date = $request->input('payment_date');
        $issue_date = $request->input('issue_date');
        $demerit_points = $request->input('demerit_points');
        $fine_amount = $request->input('fine_amount');

        $license_holder = LicenseHolder::where('id', $license_holder_id)->first();
        $user_demerit = $license_holder->total_demerit_points;
        $user_demerit = $user_demerit + $demerit_points;

        // dd($user_demerit);
        if ($user_demerit < 24) {
            $offence = new Offense();
            $offence->license_holder_id = $license_holder_id;
            $offence->policeman_id = $policeman_id;
            $offence->vehicle_class_id = $vehicle_class_id;
            $offence->fine_issued_date = $issue_date;
            $offence->payment_status = $payment_status_id;
            $offence->payment_date = $payment_date;
            $offence->total_fine_amount = $fine_amount;
            $offence->total_demerit_points = $demerit_points;

            $offence->save();

            $license_holder->total_demerit_points = $user_demerit;
            $license_holder->status_id = 3;
            $license_holder->save();

            $offence_id = $offence->id;

            foreach ($fines as $key => $fine_id) {
                $has_fine = new OffenceHasFine();
                $has_fine->offences_id = $offence_id;
                $has_fine->fine_id = $fine_id;
                $has_fine->save();
            }

            return redirect('admin/view_offences_list')->with('status', 'Added Successfully!');
        } else {
            $license_holder->total_demerit_points = $user_demerit;
            $license_holder->status_id = 3;
            $license_holder->save();
            return redirect('admin/view_offences_list')->with('status-failed', 'You are already exceed demerit points limit!');
        }
    }


    public function showReports()
    {
        $license_holders = null;
        $police_divisions = null;
        $fine_types = null;
        $vehicle_classes = null;
        $payments = null;
        return view('admin.report.report',['license_holders'=>$license_holders,'police_divisions'=>$police_divisions,'fine_types'=>$fine_types,'vehicle_classes'=>$vehicle_classes
                    ,'payments'=>$payments]);
    }

    public function showReportType($type)
    {
        $license_holders = null;
        $police_divisions = null;
        $fine_types = null;
        $vehicle_classes = null;
        $payments = null;
        if($type == 1)
        {
            $license_holders = LicenseHolder::all();

        }
        else if($type == 2)
        {
            $police_divisions =  DB::table('offenses')
                        ->join('policemen', 'offenses.policeman_id', '=', 'policemen.id')
                        ->join('police_divisions', 'policemen.division_id', '=', 'police_divisions.id')
                        ->select('police_divisions.name',DB::raw('count(policemen.id) as no_of_police_officer'),DB::raw('count(offenses.id) as no_of_offence'),
                        DB::raw('sum(offenses.total_fine_amount) as total_amount'))
                        ->groupBy('policemen.division_id')->get();
        }
        elseif($type == 3)
        {
            $fine_types = DB::table('offences_has_fines')
                          ->join('fines', 'offences_has_fines.fine_id', '=', 'fines.id')
                          ->select('fines.section_of_act',DB::raw('count(offences_has_fines.offences_id) as no_of_offences'))
                          ->groupBy('fine_id')->get();
        }
        elseif($type == 4)
        {
            $vehicle_classes = DB::table('offenses')
                            ->join('vehicle_class', 'offenses.vehicle_class_id', '=', 'vehicle_class.id')
                            ->select('vehicle_class.vehicle_class','vehicle_class.desctription',DB::raw('count(offenses.id) as no_of_offences'))
                            ->groupBy('offenses.vehicle_class_id')->get();

        }
        elseif($type == 5)
        {
            $payments = DB::table('offenses')
                            ->join('payment_statuses', 'offenses.payment_status', '=', 'payment_statuses.id')
                            ->select('payment_statuses.type',DB::raw('sum(offenses.total_fine_amount) as total_amount'))
                            ->groupBy('offenses.payment_status')->get();

        }

        return view('admin.report.report',['license_holders'=>$license_holders,'police_divisions'=>$police_divisions,'fine_types'=>$fine_types,'vehicle_classes'=>$vehicle_classes
        ,'payments'=>$payments]);
    }
}
