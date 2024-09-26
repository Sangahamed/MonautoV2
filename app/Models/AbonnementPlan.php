<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class AbonnementPlan extends Model
{
    use HasFactory;
        use Sluggable;


     protected $fillable = [
        'name',
        'description',
        'prix',
        'type'
    ];

    public function sluggable(): array
    {
        return [
            'type' => [
                'source' => 'name'
            ]
        ];
    }
}
