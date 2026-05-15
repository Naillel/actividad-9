<?php

use App\Reporting\HtmlOutput;
use App\Repositories\SalesRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $report = new \App\Reporting\SalesReporter(new SalesRepository);

    $startDate = Carbon::now()->subDays(1)->toDateString();
    $endDate = Carbon::now()->toDateString();

    return $report->between($startDate, $endDate, new HtmlOutput);
});
