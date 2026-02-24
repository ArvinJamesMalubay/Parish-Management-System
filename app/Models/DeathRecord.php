<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'death_date', 'cause_of_death',
        'burial_date', 'burial_place', 'church_book_no', 'page_no', 'notes',
    ];

    protected $casts = [
        'death_date'  => 'date',
        'burial_date' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
