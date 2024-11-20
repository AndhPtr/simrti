<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risk;
use App\Models\User;
use App\Models\RiskCategories;
use App\Models\AsetKritis;
use App\Models\KelemahanAsets;
use App\Models\Mitigation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asetCount = AsetKritis::count();
        $riskCount = Risk::count();
        $mitigationCount = Mitigation::count();
        $userCount = User::count();

        // Risk level distribution
        $riskLevels = Risk::select('rpn_level', DB::raw('count(*) as count'))
            ->groupBy('rpn_level')
            ->pluck('count', 'rpn_level')
            ->toArray();
        // Risk trends (e.g., monthly new risks)
        $riskTrends = Risk::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->pluck('count', 'month');

        return view('dashboard.index', compact(
            'asetCount',
            'riskCount',
            'mitigationCount',
            'userCount',
            'riskLevels',
            'riskTrends'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
