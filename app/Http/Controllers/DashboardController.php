<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Charts\MonthlyUsersChart;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke(MonthlyUsersChart $chart)
    {
        return Inertia::render('Dashboard', [
            'offers' => auth()->user()->currentTeam->offers,
            'chart' => $chart->build(),
            'actions' => auth()->user()->currentTeam->actions->sortByDesc('created_at')->take(auth()->user()->items_per_page_history),
        ]);
    }

    public function prefrencesItemsPerPageHistory(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->items_per_page_history = $request->items_per_page_history;
        $user->save();

        return redirect()->route('dashboard');
    }
}
