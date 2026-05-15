<?php namespace App\Reporting;

use App\Repositories\SalesRepository;


class SalesReporter
{
    public function __construct(protected SalesRepository $repo) {
        $this->repo = $repo;
    }
    
    public function between($startDate, $endDate, SalesOutputInterface $formatter)
    {

        $sales = $this->repo->between($startDate, $endDate);
        
        return $formatter->output($sales);

    }




}

