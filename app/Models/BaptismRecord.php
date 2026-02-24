<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaptismRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'baptism_date', 'officiant', 'godparents',
        'church_book_no', 'page_no', 'notes',
    ];

    protected $casts = [
        'baptism_date' => 'date',
        'godparents'   => 'array',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
