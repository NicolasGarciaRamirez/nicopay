<?php

namespace App\Models\Plan;

use App\Models\Subscription\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
        'name',
        'price',
        'description',
        'frequency',
        'active',
		'user_id'
    ];

	protected $casts = [
		'active'=>'boolean'
	];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
