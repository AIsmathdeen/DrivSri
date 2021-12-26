<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_class extends Model
{
    use HasFactory;
    protected $table = 'vehicle_class';
    protected $primarykey = 'id';
    protected $fillable = ['vehicle_class', 'desctription'];

    public function fines()
    {
        return $this->hasMany(Fine::class, 'vehicle_class_id');
    }
}
