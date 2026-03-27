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
        $validated = $request->validate([
            'type' => ['required', 'in:allowance,living_expense'],
            'amount' => ['required', 'integer', 'min:1'],
            'record_date' => ['required', 'date'],
            'note' => ['nullable', 'max:1000'],
        ], [
            'type.required' => '種類を選択してください。',
            'type.in' => '種類の値が正しくありません。',
            'amount.required' => '金額を入力してください。',
            'amount.integer' => '金額は数字で入力してください。',
            'amount.min' => '金額は1円以上で入力してください。',
            'record_date.required' => '日付を入力してください。',
            'record_date.date' => '正しい日付を入力してください。',
            'note.max' => 'メモは1000文字以内で入力してください。',
        ]);

        MoneyRecord::create([
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'record_date' => $validated['record_date'],
            'note' => $validated['note'] ?? null,
            'is_received' => $request->has('is_received'),
        ]);

        return redirect()->route('money-records.index');
    }
}
