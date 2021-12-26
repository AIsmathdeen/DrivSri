<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCerification extends Model
{
    use HasFactory;

    protected $table='request_cerifications';
    protected $primarykey = 'id';
    protected $fillable = ['license_holder_id '];

    public function license_holders()
    {
        return $this->belongsTo(LicenseHolder::class, 'license_holder_id');

    }
}
