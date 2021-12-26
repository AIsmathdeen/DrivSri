<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'payment_statuses';
    protected $primarykey = 'id';
    protected $fillable = ['type'];

    public function offenses() {
        return $this->hasMany(Offense::class,'id');
    }

}
