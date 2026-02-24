<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'gender',
        'birth_date', 'birth_place', 'address', 'contact_number',
        'email', 'civil_status', 'family_id', 'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function baptismRecord()
    {
        return $this->hasOne(BaptismRecord::class);
    }

    public function confirmationRecord()
    {
        return $this->hasOne(ConfirmationRecord::class);
    }

    public function deathRecord()
    {
        return $this->hasOne(DeathRecord::class);
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}
