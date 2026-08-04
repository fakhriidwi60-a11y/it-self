<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProblemController extends Controller
{
    public function index(Request $request): View
    {
        $problems = $this->filteredQuery($request)->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('problems.index', [
            'problems' => $problems,
            'categories' => $categories,
            'search' => $request->string('search'),
            'categoryFilter' => (int) $request->input('category', 0),
        ]);
    }

    /**
     * AJAX partial used for the live-search table body.
     */
    public function search(Request $request): View
    {
        $problems = $this->filteredQuery($request)->paginate(10)->withQueryString();

        return view('problems.partials.table-rows', ['problems' => $problems]);
    }

    public function show(Problem $problem): View
    {
        $problem->load(['category', 'solutions']);

        return view('problems.show', ['problem' => $problem]);
    }

    private function filteredQuery(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = (int) $request->input('category', 0);

        return Problem::query()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($categoryFilter > 0, fn ($query) => $query->where('category_id', $categoryFilter))
            ->orderByDesc('created_at');
    }
}
