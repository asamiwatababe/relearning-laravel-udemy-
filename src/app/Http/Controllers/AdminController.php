<?php

namespace App\Http\Controllers;

use App\Models\MoneyRecord;
use App\Models\ChoreRecord;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $recentMoneyRecords = MoneyRecord::with('user')
            ->where('type', 'allowance')
            ->latest('record_date')
            ->limit(5)
            ->get();

        $recentChoreRecords = ChoreRecord::with(['user', 'chore'])
            ->latest('record_date')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'recentMoneyRecords',
            'recentChoreRecords',
            'now',
        ));
    }
}
