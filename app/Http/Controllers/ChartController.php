<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LicenseHolder;
use App\Models\Offense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class ChartController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index()
    {
        $users = User::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');

        $months = User::select(DB::raw("Month(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('month');

        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index =>$month)
        {
            $datas[$month]=$users[$index];
        }
        return view('chart', compact('datas'));
    }

   public function numberOfOffence()
   {

        $users = Offense::select(DB::raw("COUNT(id) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');

        $months =Offense::select(DB::raw("Month(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('month');

        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index =>$month)
        {
            $datas[$month]=$users[$index];
        }
        return view('chart', compact('datas'));
   }

}
