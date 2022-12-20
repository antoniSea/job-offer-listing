<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Charts\MonthlyUsersChart;

class DashboardController extends Controller
{
    public function __invoke(MonthlyUsersChart $chart)
    {
        return Inertia::render('Dashboard', [
            'offers' => auth()->user()->currentTeam->offers,
            'chart' => $chart->build()
        ]);
    }
}
