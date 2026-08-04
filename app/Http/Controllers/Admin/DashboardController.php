<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Problem;
use App\Models\Report;
use App\Models\Solution;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'userCount' => User::where('role', 'user')->count(),
            'categoryCount' => Category::count(),
            'problemCount' => Problem::count(),
            'solutionCount' => Solution::count(),
            'reportCount' => Report::count(),
            'pendingReportCount' => Report::where('status', 'pending')->count(),
        ]);
    }
}