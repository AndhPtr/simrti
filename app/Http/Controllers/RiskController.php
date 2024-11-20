<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use App\Models\RiskCategories;
use App\Http\Requests\RiskRequest;
use App\Models\AsetKritis;
use App\Models\KelemahanAsets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RiskController extends Controller
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

        $risks = Risk::with('asetKritis')
            ->when($sortBy === 'kategori_id', function ($query) use ($sortDirection) {
                $query->join('aset_kritis', 'risks.aset_id', '=', 'aset_kritis.id')
                    ->orderBy('aset_kritis.kategori_id', $sortDirection);
            }, function ($query) use ($sortBy, $sortDirection) {
                $query->orderBy($sortBy, $sortDirection);
            })
            ->get();
        $asets = AsetKritis::all();
        $riskcategories = RiskCategories::all();

        return view('risks.index', [
            'risks' => $risks,
            'riskcategories' => $riskcategories,
            'asets' => $asets,
            'elementActive' => 'evaluate',
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
        return view('risks.create', ['riskcategories' => $riskcategories, 'asets' => $asets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'aset_id' => 'required',
            'risiko' => 'required',
            'penyebab' => 'required',
            'dampak' => 'required',
            'severity' => 'required',
            'occurence' => 'required',
            'detection' => 'required',
            'rpn_level' => 'required',
        ]);

        $data['rpn'] = $data['severity'] * $data['occurence'] * $data['detection'];


        Risk::create($data);

        return redirect()->route('risks.index')->with('success', 'Risiko Aset saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $risk = Risk::find($id);
        $riskcategories = RiskCategories::all();
        $asets = AsetKritis::all();
        return view('risks.edit', ['risk' => $risk, 'riskcategories' => $riskcategories, 'asets' => $asets]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $risk = Risk::find($id);

        $data = $request->validate([
            'aset_id' => 'required',
            'risiko' => 'required',
            'penyebab' => 'required',
            'dampak' => 'required',
            'severity' => 'required',
            'occurence' => 'required',
            'detection' => 'required',
            'rpn_level' => 'required',
        ]);
        $data['rpn'] = $data['severity'] * $data['occurence'] * $data['detection'];

        $risk->update($data);

        return redirect()->route('risks.index')->with('success', 'Risiko Aset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $risk = Risk::findOrFail($id);
        $risk->delete();

        return redirect()->route('risks.index')->with('success', 'Risk deleted successfully');
    }
}
