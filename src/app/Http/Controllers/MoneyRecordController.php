<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoneyRecordController extends Controller
{
    public function index()
    {
        return view('money-records.index');
    }

    public function create()
    {
        return view('money-records.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('money-records.index');
    }
}
