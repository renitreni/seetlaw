<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyCase;
use App\Models\ClientCase;
use App\Models\ClientCourt;
use App\Models\Gallery;
use App\Models\Invoice;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke(MonthlyCase $chart)
    {
        $date = Carbon::now();
        $schedules = ClientCourt::whereYear('court_date', $date->year)->whereMonth('court_date', $date->month)->whereDay('court_date', '>', $date->day)->with('case')->get();
        $totalCase = ClientCase::count();
        $totalPhotos = Gallery::count();
        $totalInvoice = Invoice::count();

        return view('dashboard', ['chart' => $chart->build()])
            ->with([
                'scheds' => $schedules,
                'totalCase' => $totalCase,
                'totalPhotos' => $totalPhotos,
                'totalInvoice' => $totalInvoice,
            ]);
    }
}
