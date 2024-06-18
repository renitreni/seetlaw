<?php

namespace App\Charts;

use App\Models\ClientCase;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MonthlyCase
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $currentYear = Carbon::now()->year;
        $monthsName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $months = range(1, 12);
        $totalCasePerMonth = [];

        foreach ($months as $month) {
            $totalCasePerMonth[] = ClientCase::whereYear('case_date', $currentYear)
                ->whereMonth('case_date', $month)
                ->count();
        }

        return $this->chart->lineChart()
            ->setTitle("Cases during {$currentYear}")
            ->setColors(['#3e8e78'])
            ->setSubtitle('Total records per month of this current year.')
            ->addData('Records', $totalCasePerMonth)
            ->setXAxis($monthsName);
    }
}
