<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendre;
use App\Models\Location;



class Concession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'concession_name',
        'concession_phone',
        'concession_address',
        'concession_description',
        'concession_logo',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class, 'user_id', 'user_id');
    }

    public function vendres()
    {
        return $this->hasMany(Vendre::class, 'user_id', 'user_id');
    }
}
