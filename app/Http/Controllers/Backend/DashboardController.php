<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Location;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalVisitor = $this->getTotalVisitors();
        $lastWeekVisitor = $this->getLastWeekVisitors();
        $mostViewedCountry = $this->getMostViewedVisitorCountry();
        $currentUsers = $this->getCurrentUsers();
        return view('backend.dashboard')->with([
            'totalVisitor' => $totalVisitor,
            'lastWeekVisitor' => $lastWeekVisitor,
            'mostViewedCountry' => $mostViewedCountry,
            'currentUsers' => $currentUsers
            ]);
    }

    public function test()
    {
    	return view('backend.test');
    }
}
