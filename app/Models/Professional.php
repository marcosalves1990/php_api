<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'crm',
        'contact',
        'email',
        'hire_date',
        'start_time',
        'end_time',
        'status'
    ];

    protected $casts = [
        'hire_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'status' => 'boolean',
    ];
/*
    public function availabilityDays()
    {
        return $this->hasMany(AvailabilityDay::class, 'professional_id');
    }*/
}
