<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'confirmation_date', 'officiant',
        'sponsor', 'church_book_no', 'page_no', 'notes',
    ];

    protected $casts = [
        'confirmation_date' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
