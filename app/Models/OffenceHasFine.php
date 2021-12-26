<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffenceHasFine extends Model
{
    use HasFactory;

    protected $table = 'offences_has_fines';
    protected $primarykey = 'id';
    protected $fillable = ['offences_id', 'fine_id'];

    public function offence()
    {
        return $this->belongsTo(Offense::class, 'offences_id');
    }

    public function fine()
    {

        return $this->belongsTo(Fine::class, 'fine_id');
    }


}
