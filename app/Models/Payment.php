<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'user_id', 'abonnement_plan_id', 'amount', 'currency', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function abonnementPlan()
    {
        return $this->belongsTo(AbonnementPlan::class);
    }
}
