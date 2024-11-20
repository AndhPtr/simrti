<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use App\Models\RiskCategories;
use App\Http\Requests\RiskRequest;
use App\Models\AsetKritis;
use App\Models\KelemahanAsets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class KelemahanAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sortBy = $request->query('sort_by', 'kategori_id'); // Default sort column
        $sortDirection = $request->query('sort_direction', 'asc'); // Default sort direction

        $asets = AsetKritis::orderBy($sortBy, $sortDirection)->get();
        $kelemahan_aset = KelemahanAsets::with(['asetKritis.riskCategories'])
            ->join('aset_kritis', 'kelemahan_asets.aset_id', '=', 'aset_kritis.id') // Join aset_kritis table
            ->join('risk_categories', 'aset_kritis.kategori_id', '=', 'risk_categories.id') // Join risk_categories table
            ->select('kelemahan_asets.*') // Ensure we only fetch kelemahan_asets columns for the main model
            ->orderBy('risk_categories.kategori_risiko') // Sort by kategori_risiko
            ->orderBy('aset_kritis.name') // Sort by aset_kritis name
            ->get();
        $riskcategories = RiskCategories::all();

        return view('kelemahan.index', [
            'kelemahan_aset' => $kelemahan_aset,
            'riskcategories' => $riskcategories,
            'asets' => $asets,
            'elementActive' => 'risk',
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riskcategories = RiskCategories::all();
        $asets = AsetKritis::all();
        return view('kelemahan.create', ['riskcategories' => $riskcategories, 'asets' => $asets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'aset_id' => 'required',
            'kelemahan' => 'required',
            'kebutuhan_keamanan' => 'required',
            'praktik_keamanan' => 'required',
        ]);

        KelemahanAsets::create($data);

        return redirect()->route('kelemahan.index')->with('success', 'Keterangan saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelemahan_aset = KelemahanAsets::find($id);
        $riskcategories = RiskCategories::all();
        $asets = AsetKritis::all();
        return view('kelemahan.edit', ['kelemahan_aset' => $kelemahan_aset, 'riskcategories' => $riskcategories, 'asets' => $asets]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelemahan_aset = KelemahanAsets::find($id);

        $data = $request->validate([
            'aset_id' => 'required',
            'kelemahan' => 'required',
            'kebutuhan_keamanan' => 'required',
            'praktik_keamanan' => 'required',
        ]);

        $kelemahan_aset->update($data);

        return redirect()->route('kelemahan.index')->with('success', 'Keterangan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KelemahanAsets::find($id)->delete();
        return redirect()->route('kelemahan.index')->with('success', 'Kelemahan Aset deleted successfully.');
    }
}
