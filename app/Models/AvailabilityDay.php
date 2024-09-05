<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityDay extends Model
{
    use HasFactory;

    protected $table = 'availability_days';

    protected $fillable = [
        'professional_id',
        'dia_semana'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }
}
