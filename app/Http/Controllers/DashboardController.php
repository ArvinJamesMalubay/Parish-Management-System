<?php

namespace App\Http\Controllers;

use App\Models\BaptismRecord;
use App\Models\MarriageRecord;
use App\Models\DeathRecord;
use App\Models\ConfirmationRecord;
use App\Models\Member;
use App\Models\Family;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'members'       => Member::count(),
            'families'      => Family::count(),
            'baptisms'      => BaptismRecord::count(),
            'marriages'     => MarriageRecord::count(),
            'deaths'        => DeathRecord::count(),
            'confirmations' => ConfirmationRecord::count(),
        ];

        $recentBaptisms      = BaptismRecord::with('member')->latest()->take(5)->get();
        $recentMarriages     = MarriageRecord::with('groom', 'bride')->latest()->take(5)->get();
        $recentConfirmations = ConfirmationRecord::with('member')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentBaptisms', 'recentMarriages', 'recentConfirmations'));
    }
}
