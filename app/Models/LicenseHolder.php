<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicenseHolder extends Model
{
    use HasFactory;
     use SoftDeletes;


    protected $date=['deleted_at'];
    protected $table = 'license_holders';
    protected $primarykey = 'id';
    protected $fillable = ['license_no', 'first_name','last_name', 'first_name', 'last_name', 'mobile_no', 'postal_address', 'dob', 'expiry_date', 'total_demerit_points','status_id','last_fine_issued_date'];

    public function licenseStatus()
    {
        return $this->belongsTo(LicenseStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function fines()
    {
        return $this->hasOne(Fine::class, 'license_holder_id');
    }

    public function requestCertification()
    {
        return $this->hasOne(RequestCerification::class, 'license_holder_id');

    }

    public function offense()
    {
        return $this->hasMany(Offense::class, 'license_holder_id');
    }

    public function totalDemerit($id)
    {
        $offences = Offense::where('license_holder_id',$id)->get();
       // dd($offences);
        $total_fine_amount =0;
        foreach($offences as $offence)
        {
            $total_fine_amount = $total_fine_amount + $offence->total_fine_amount;
        }
        return $total_fine_amount;
     }
 }
