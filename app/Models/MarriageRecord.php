<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarriageRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'groom_member_id', 'bride_member_id', 'marriage_date',
        'officiant', 'witnesses', 'church_book_no', 'page_no', 'notes',
    ];

    protected $casts = [
        'marriage_date' => 'date',
        'witnesses'     => 'array',
    ];

    public function groom()
    {
        return $this->belongsTo(Member::class, 'groom_member_id');
    }

    public function bride()
    {
        return $this->belongsTo(Member::class, 'bride_member_id');
    }
}
