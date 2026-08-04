<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SolutionController extends Controller
{
    public function index(): View
    {
        return view('admin.solutions.index', [
            'solutions' => Solution::with('problem')->orderByDesc('created_at')->get(),
            'problems' => Problem::with('category')->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'problem_id' => ['required', 'exists:problems,id'],
            'title' => ['required', 'string', 'max:255'],
            'steps' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        Solution::create($validated);

        return back()->with('success', 'Solusi berhasil ditambahkan!');
    }

    public function update(Request $request, Solution $solution): RedirectResponse
    {
        $validated = $request->validate([
            'problem_id' => ['required', 'exists:problems,id'],
            'title' => ['required', 'string', 'max:255'],
            'steps' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $solution->update($validated);

        return back()->with('success', 'Solusi berhasil diperbarui!');
    }

    public function destroy(Solution $solution): RedirectResponse
    {
        $solution->delete();

        return back()->with('success', 'Solusi berhasil dihapus!');
    }
}
