<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\ChoreRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChoreRecordController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', now()->format('Y-m'));
        $currentDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();

        $users = User::with(['choreRecords' => function ($query) use ($currentDate) {
            $query->whereYear('record_date', $currentDate->year)
                ->whereMonth('record_date', $currentDate->month);
        }])->latest()->get();

        $choreRecords = ChoreRecord::with(['user', 'chore'])
            ->whereYear('record_date', $currentDate->year)
            ->whereMonth('record_date', $currentDate->month)
            ->latest('record_date')
            ->get();

        return view('chore-records.index', compact('users', 'choreRecords', 'selectedMonth'));
    }

    public function create()
    {
        $users = User::latest()->get();
        $chores = Chore::orderBy('category')->orderBy('name')->get();

        return view('chore-records.create', compact('users', 'chores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'chore_id' => ['required', 'exists:chores,id'],
            'record_date' => ['required', 'date'],
        ], [
            'user_id.required' => 'ユーザーを選択してください。',
            'chore_id.required' => 'お手伝いを選択してください。',
            'record_date.required' => '日付を入力してください。',
        ]);

        ChoreRecord::create([
            'user_id' => $validated['user_id'],
            'chore_id' => $validated['chore_id'],
            'record_date' => $validated['record_date'],
            'points' => 10,
        ]);

        return redirect()
            ->route('chore-records.index')
            ->with('success');
    }

    public function edit(ChoreRecord $choreRecord)
    {
        $users = User::latest()->get();
        $chores = Chore::orderBy('category')->orderBy('name')->get();

        return view('chore-records.edit', compact('choreRecord', 'users', 'chores'));
    }

    public function update(Request $request, ChoreRecord $choreRecord)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'chore_id' => ['required', 'exists:chores,id'],
            'record_date' => ['required', 'date'],
        ], [
            'user_id.required' => 'ユーザーを選択してください。',
            'chore_id.required' => 'お手伝いを選択してください。',
            'record_date.required' => '日付を入力してください。',
        ]);

        $choreRecord->update([
            'user_id' => $validated['user_id'],
            'chore_id' => $validated['chore_id'],
            'record_date' => $validated['record_date'],
            'points' => 10,
        ]);

        return redirect()
            ->route('chore-records.index')
            ->with('success');
    }

    public function destroy(ChoreRecord $choreRecord)
    {
        $choreRecord->delete();

        return redirect()
            ->route('chore-records.index')
            ->with('success');
    }
}
