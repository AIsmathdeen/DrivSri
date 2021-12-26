<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LicenseStatus extends Model
{
    use HasFactory;
    protected $table = 'license_statuses';
    protected $primarykey = 'id';
    protected $fillable = ['type'];

    public function licenseHolders() {
        return $this->hasMany(LicenseHolder::class,'status_id');
    }
}
