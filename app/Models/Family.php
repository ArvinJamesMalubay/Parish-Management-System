<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_name', 'head_member_id', 'address', 'notes',
    ];

    public function head()
    {
        return $this->belongsTo(Member::class, 'head_member_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
