<?php

namespace App\Http\Controllers;

use App\Models\Mitigation;
use App\Models\Risk;
use App\Http\Requests\RiskRequest;
use App\Models\AsetKritis;
use App\Models\RiskCategories;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MitigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mitigations = Mitigation::with('risk')->get();
        return view('mitigations.index', ['mitigations' => $mitigations, 'elementActive' => 'mitigation']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riskcategories = RiskCategories::all();
        $risks = Risk::all();
        $asets = AsetKritis::all();
        return view('mitigations.create', ['risks' => $risks, 'riskcategories' => $riskcategories, 'asets'=>$asets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'risk_id' => 'required',
            'tindakan_mitigasi' => 'required',
        ]);

        Mitigation::create($data);

        return redirect()->route('mitigations.index')->with('success', 'Mitigation inputed successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mitigation = Mitigation::find($id);
        $riskcategories = RiskCategories::all();
        $risks = Risk::all();
        return view('mitigations.edit', ['risks' => $risks, 'mitigation' => $mitigation, 'riskcategories' => $riskcategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mitigation = Mitigation::find($id);

        $data = $request->validate([
            'risk_id' => 'required', // Ensure this validation is not failing
            'tindakan_mitigasi' => 'required',
        ]);

        // Update the mitigation record
        $mitigation->update($data);

        return redirect()->route('mitigations.index')->with('success', 'Mitigation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mitigation::find($id)->delete();
        return redirect()->route('mitigations.index')->with('success', 'Mitigation deleted successfully.');
    }
}
