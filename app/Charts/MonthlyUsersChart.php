<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
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
        return $this->chart->barChart()
            ->setTitle('Oferty w miesiącu')
            ->setSubtitle('Oferty w miesiącu')
            ->addData('Users', [
                100, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120])
            ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
            ->toVue();
    }
}
