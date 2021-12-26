<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Fine extends Model
{
    use HasFactory;

    protected $table = 'fines';
    protected $primarykey = 'id';
    protected $fillable = ['fine_amount', 'demerit_points' , 'provision', 'section_of_act'];

    public function offenses()
    {
        return $this->belongsToMany(Offense::class, 'offences_has_fines','fine_id','offences_id');
    }

    public function license_holders()
    {
        return $this->belongsTo(LicenseHolder::class, 'license_holder_id');
    }

    public function vehicle_class()
    {
        return $this->belongsTo(Vehicle_class::class, 'vehicle_class_id');
    }

}
