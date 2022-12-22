<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\OfferView;
use App\Models\Offer;
use Inertia\Inertia;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {
        $offers = auth()->user()->currentTeam->offers()->with('views')->get();
        $views = [];
        foreach ($offers as $offer) {
            foreach ($offer->views as $view) {
                $views[] = $view;
            }
        }
        $viewsArray = [[], [], [], [], [], [], []];
        
        foreach ($viewsArray as $key => $value) {
            $viewsArray[$key] = array_filter($views, function ($view) use ($key) {
                return $view->created_at->month == now()->subMonths($key)->month;
            });
        }



        $offers = OfferView::where('created_at', '>=', now()->startOfMonth())->get();
        return $this->chart->barChart()
            ->setTitle('Wyświetlenia ofert w miesiącu')
            ->setSubtitle('Wyświetlenia ofert w miesiącu')
            ->addData('Wyświetlania ofert', [count($viewsArray[6]), count($viewsArray[5]), count($viewsArray[4]), count($viewsArray[3]), count($viewsArray[2]), count($viewsArray[1]), count($viewsArray[0])])
            ->setXAxis(['Sześć miesięcy temu', 'Pięć miesięcy temu', 'Cztery miesiące temu', 'Trzy miesiące temu', 'Dwa miesiące temu', 'Miesiąc temu', 'W tym miesiącu'])
            ->toVue();
    }
}
