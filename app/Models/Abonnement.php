<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AbonnementPlan;
use App\Models\User;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'abonnement_plan_id', 'start_date', 'end_date'];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function abonnementPlan()
    {
        return $this->belongsTo(AbonnementPlan::class);
    }
}
