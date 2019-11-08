<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Visitor\Visitor;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getTotalVisitors()
    {
    	$visitorModel = new Visitor();

    	return $visitorModel->all()->sum('count');
    }

    public function getLastWeekVisitors()
    {
    	$visitorModel = new Visitor();

    	$today = Carbon::today();

    	return $visitorModel->where('updated_at', '>=', $today->subDays(7))
    						->sum('count');
    }

    public function getMostViewedVisitorCountry()
    {
    	$visitorModel = new Visitor();

    	$country = $visitorModel->groupBy('country_code')
			    ->orderByRaw('COUNT(*) DESC')
			    ->limit(1)
			    ->first();

	    if($country)
	    {
	    	return $country->country_code;
	    }

    	return null;
    }

    public function getCurrentUsers()
    {
    	$visitorModel = new Visitor();

    	$timeToCompare = Carbon::now()->subMinutes(10)->toDateTimeString();

    	return $visitorModel->where('updated_at', '>=', $timeToCompare)
    						->count();
    }
}
