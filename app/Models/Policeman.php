<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policeman extends Model
{
    use HasFactory,softDeletes;

 

    protected $table = 'policemen';
    protected $primarykey = 'id';
    protected $fillable = ['first_name', 'last_name', 'mobile_number', 'dob', 'postal_address', 'registration_number', 'division_id'];
    protected $dates=['deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function policeDivision()
    {
        return $this->belongsTo(Police_division::class, 'division_id');
    }

}
