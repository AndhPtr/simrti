<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risk;
use App\Models\User;
use App\Models\RiskCategories;
use App\Models\AsetKritis;
use App\Models\KelemahanAsets;
use App\Models\Mitigation;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated.
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        // Check if the view exists
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}",);
        }

        // Return a 404 error if the page does not exist
        return abort(404);
    }

    public function dashboard()
    {
        $asetCount = AsetKritis::count();
        $riskCount = Risk::count();
        $mitigationCount = Mitigation::count();
        $userCount = User::count();

        // Risk level distribution
        $riskLevels = Risk::selectRaw('level, COUNT(*) as count')
            ->groupBy('level')
            ->pluck('count', 'level');

        // Risk trends (e.g., monthly new risks)
        $riskTrends = Risk::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->pluck('count', 'month');

        return view('dashboard', compact(
            'asetCount',
            'riskCount',
            'mitigationCount',
            'userCount',
            'riskLevels',
            'riskTrends'
        ));
    }
}
