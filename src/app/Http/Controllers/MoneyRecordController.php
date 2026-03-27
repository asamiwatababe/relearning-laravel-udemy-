<?php

namespace App\Http\Controllers;

use App\Models\MoneyRecord;
use Illuminate\Http\Request;

class MoneyRecordController extends Controller
{
    public function index()
    {
        $moneyRecords = MoneyRecord::latest()->get();

        return view('money-records.index', compact('moneyRecords'));
    }

    public function create()
    {
        return view('money-records.create');
    }

    public function store(Request $request)
    {
        MoneyRecord::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'record_date' => $request->record_date,
            'note' => $request->note,
            'is_received' => $request->has('is_received'),
        ]);

        return redirect()->route('money-records.index');
    }
}
