<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Problem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProblemController extends Controller
{
    public function index(): View
    {
        return view('admin.problems.index', [
            'problems' => Problem::with('category')
                ->withCount('solutions')
                ->orderByDesc('created_at')
                ->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        Problem::create($validated);

        return back()->with('success', 'Problem berhasil ditambahkan!');
    }

    public function update(Request $request, Problem $problem): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $problem->update($validated);

        return back()->with('success', 'Problem berhasil diperbarui!');
    }

    public function destroy(Problem $problem): RedirectResponse
    {
        $problem->delete();

        return back()->with('success', 'Problem berhasil dihapus!');
    }
}
