<?php

namespace App\Http\Controllers;

use App\Models\MoneyRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MoneyRecordController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', now()->format('Y-m'));
        $currentDate = Carbon::parse($selectedMonth . '-01');

        $currentMonthLivingExpense = MoneyRecord::firstOrCreate(
            [
                'type' => 'living_expense',
                'record_date' => $currentDate->toDateString(),
            ],
            [
                'amount' => 80000,
                'note' => $currentDate->format('Y年n月') . 'の生活費',
                'is_received' => false,
            ]
        );

        $moneyRecords = MoneyRecord::with('user')
            ->where('type', 'allowance')
            ->whereYear('record_date', $currentDate->year)
            ->whereMonth('record_date', $currentDate->month)
            ->latest('record_date')
            ->get();

        $users = User::with([
            'moneyRecords' => function ($q) use ($currentDate) {
                $q->where('type', 'allowance')
                    ->whereYear('record_date', $currentDate->year)
                    ->whereMonth('record_date', $currentDate->month);
            },
            'choreRecords' => function ($q) use ($currentDate) {
                $q->whereYear('record_date', $currentDate->year)
                    ->whereMonth('record_date', $currentDate->month);
            },
        ])->latest()->get();

        return view('money-records.index', compact(
            'moneyRecords',
            'currentMonthLivingExpense',
            'selectedMonth',
            'users',
        ));
    }

    public function create()
    {
        $users = User::latest()->get();

        return view('money-records.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'record_date' => ['required', 'date', 'before_or_equal:today'],
            'note' => ['nullable', 'max:1000'],
        ], [
            'user_id.required' => 'ユーザーを選択してください。',
            'user_id.exists' => '正しいユーザーを選択してください。',
            'amount.required' => '金額を入力してください。',
            'amount.integer' => '金額は数字で入力してください。',
            'amount.min' => '金額は1円以上で入力してください。',
            'record_date.required' => '日付を入力してください。',
            'record_date.date' => '正しい日付を入力してください。',
            'record_date.before_or_equal' => '日付は今日以前を入力してください。',
            'note.max' => 'メモは1000文字以内で入力してください。',
        ]);

        MoneyRecord::create([
            'user_id' => $validated['user_id'],
            'type' => 'allowance',
            'amount' => $validated['amount'],
            'record_date' => $validated['record_date'],
            'note' => $validated['note'] ?? null,
            'is_received' => true,
        ]);

        return redirect()
            ->route('money-records.index')
            ->with('success');
    }

    public function edit(MoneyRecord $moneyRecord)
    {
        if ($moneyRecord->type !== 'allowance') {
            abort(404);
        }

        $users = User::latest()->get();

        return view('money-records.edit', compact('moneyRecord', 'users'));
    }

    public function update(Request $request, MoneyRecord $moneyRecord)
    {
        if ($moneyRecord->type !== 'allowance') {
            abort(404);
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'record_date' => ['required', 'date', 'before_or_equal:today'],
            'note' => ['nullable', 'max:1000'],
        ], [
            'user_id.required' => 'ユーザーを選択してください。',
            'user_id.exists' => '正しいユーザーを選択してください。',
            'amount.required' => '金額を入力してください。',
            'amount.integer' => '金額は数字で入力してください。',
            'amount.min' => '金額は1円以上で入力してください。',
            'record_date.required' => '日付を入力してください。',
            'record_date.date' => '正しい日付を入力してください。',
            'record_date.before_or_equal' => '日付は今日以前を入力してください。',
            'note.max' => 'メモは1000文字以内で入力してください。',
        ]);

        $moneyRecord->update([
            'user_id' => $validated['user_id'],
            'amount' => $validated['amount'],
            'record_date' => $validated['record_date'],
            'note' => $validated['note'] ?? null,
        ]);

        return redirect()
            ->route('money-records.index')
            ->with('success');
    }

    public function destroy(MoneyRecord $moneyRecord)
    {
        if ($moneyRecord->type !== 'allowance') {
            abort(404);
        }

        $moneyRecord->delete();

        return redirect()
            ->route('money-records.index')
            ->with('success');
    }

    public function toggleReceivedAjax(MoneyRecord $moneyRecord)
    {
        if ($moneyRecord->type !== 'living_expense') {
            return response()->json([
                'success' => false,
                'message' => '生活費のみ更新できます。'
            ], 422);
        }

        $moneyRecord->update([
            'is_received' => ! $moneyRecord->is_received,
        ]);

        return response()->json([
            'success' => true,
            'is_received' => $moneyRecord->is_received,
            'button_text' => $moneyRecord->is_received ? '受取済み' : '未受け取り',
        ]);
    }
}
