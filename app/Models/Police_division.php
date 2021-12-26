<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Police_division extends Model
{
    use HasFactory;
    protected $table = 'police_divisions';
    protected $primarykey = 'id';
    protected $fillable = ['name'];


    public function policemen()
    {
        return $this->hasMany(Policeman::class, 'division_id');
    }
}


