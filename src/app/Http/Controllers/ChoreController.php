<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use Illuminate\Http\Request;

class ChoreController extends Controller
{
    public function index()
    {
        $chores = Chore::orderBy('category')->orderBy('name')->get();

        return view('chores.index', compact('chores'));
    }

    public function create()
    {
        return view('chores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'name'     => ['required', 'string', 'max:100'],
            'points'   => ['required', 'integer', 'min:1', 'max:1000'],
        ], [
            'category.required' => 'カテゴリを入力してください。',
            'name.required'     => 'お手伝い名を入力してください。',
            'points.required'   => 'ポイントを入力してください。',
            'points.min'        => 'ポイントは1以上を入力してください。',
        ]);

        Chore::create($validated);

        return redirect()->route('chores.index')->with('success', '登録しました。');
    }

    public function edit(Chore $chore)
    {
        return view('chores.edit', compact('chore'));
    }

    public function update(Request $request, Chore $chore)
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'name'     => ['required', 'string', 'max:100'],
            'points'   => ['required', 'integer', 'min:1', 'max:1000'],
        ], [
            'category.required' => 'カテゴリを入力してください。',
            'name.required'     => 'お手伝い名を入力してください。',
            'points.required'   => 'ポイントを入力してください。',
            'points.min'        => 'ポイントは1以上を入力してください。',
        ]);

        $chore->update($validated);

        return redirect()->route('chores.index')->with('success', '更新しました。');
    }

    public function destroy(Chore $chore)
    {
        $chore->delete();

        return redirect()->route('chores.index')->with('success', '削除しました。');
    }
}
