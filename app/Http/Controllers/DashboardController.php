<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Problem;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'user' => Auth::user(),
            'categoryCount' => Category::count(),
            'problemCount' => Problem::count(),
            'solutionCount' => Solution::count(),
        ]);
    }
}