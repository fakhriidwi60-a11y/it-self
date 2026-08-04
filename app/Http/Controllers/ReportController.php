<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'solution_id' => ['required', 'exists:solutions,id'],
            'description' => ['required', 'string'],
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'solution_id' => $validated['solution_id'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim ke tim IT!');
    }

    public function userReports(): View
    {
        $reports = Report::with(['solution.problem'])
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('reports.index', ['reports' => $reports]);
    }

    public function index(): View
    {
        $reports = Report::with(['user', 'solution.problem'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.reports.index', ['reports' => $reports]);
    }

    public function update(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,complete'],
        ]);

        $report->update(['status' => $validated['status']]);

        return back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}
