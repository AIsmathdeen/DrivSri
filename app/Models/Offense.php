<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offense extends Model
{
    use HasFactory;

    protected $table = 'offenses';
    protected $primarykey = 'id';
    protected $fillable = ['license_holder_id', 'policeman_id', 'vehicle_class_id','fine_issued_date', 'payment_status', 'payment_date', 'total_fine_amount','total_demerit_points'];

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status');
    }

    public function licensedHolder()
    {
        return $this->belongsTo(LicenseHolder::class, 'license_holder_id');
    }

    public function police()
    {

        return $this->belongsTo(Policeman::class, 'policeman_id');
    }

    public function vehicle()
    {

        return $this->belongsTo(Vehicle_class::class, 'vehicle_class_id');
    }

  public function fine()
  {
    return $this->belongsToMany(Fine::class, 'offences_has_fines','offences_id','fine_id');
  }


}
