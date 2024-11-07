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

        $asets = AsetKritis::orderBy($sortBy, $sortDirection)->get();
        $kelemahan_aset = KelemahanAsets::all();
        $riskcategories = RiskCategories::all();

        return view('risks.index', [
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
        $aset = AsetKritis::all();
        return view('risks.create', ['riskcategories' => $riskcategories, 'aset' => $aset]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('kelemahan')) {

            $data = $request->validate([
                'aset_id' => 'required',
                'kelemahan' => 'required',
                'kebutuhan_keamanan' => 'required',
                'praktik_keamanan' => 'required',
            ]);

            KelemahanAsets::create($data);

            return redirect()->route('risks.index')->with('success', 'Keterangan saved successfully.');
        } elseif ($request->has('risiko')) {

            $data = $request->validate([
                'kelemahan_id' => 'required',
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

            return redirect()->route('risks.evaluate')->with('success', 'Risiko Aset saved successfully.');
        }

        return redirect()->back()->withErrors('Invalid form submission.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $risk = Risk::find($id);
        $riskcategories = RiskCategories::all();
        $aset = AsetKritis::all();
        return view('risks.edit', ['risk' => $risk, 'riskcategories' => $riskcategories, 'aset' => $aset]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->has('kelemahan')) {

            $kelemahan_aset = KelemahanAsets::find($id);

            $data = $request->validate([
                'aset_id' => 'required',
                'kelemahan' => 'required',
                'kebutuhan_keamanan' => 'required',
                'praktik_keamanan' => 'required',
            ]);

            $kelemahan_aset->update($data);

            return redirect()->route('risks.index')->with('success', 'Keterangan updated successfully.');
        } elseif ($request->has('risiko')) {

            $risk = Risk::find($id);

            $data = $request->validate([
                'kelemahan_id' => 'required',
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

            return redirect()->route('risks.evaluate')->with('success', 'Risiko Aset updated successfully.');
        }

        // Optional: Fallback if neither form is recognized
        return redirect()->back()->withErrors('Invalid form submission.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Risk::find($id) != null) {
            Risk::find($id)->delete();
            return redirect()->route('risks.index')->with('success', 'Risk deleted successfully.');
        } elseif (KelemahanAsets::find($id) != null) {
            KelemahanAsets::find($id)->delete();
            return redirect()->route('risks.index')->with('success', 'Kelemahan Aset deleted successfully.');
        } else {
            return redirect()->back()->withErrors('Invalid delete submission.');
        }
    }

    public function evaluate(Request $request)
    {
        $sortBy = $request->query('sort_by', 'kategori_id'); // Default sort column
        $sortDirection = $request->query('sort_direction', 'asc'); // Default sort direction

        $risks = Risk::orderBy($sortBy, $sortDirection)->get();
        $asets = AsetKritis::all();
        $riskcategories = RiskCategories::all();

        return view('risks.evaluate', [
            'risks' => $risks,
            'riskcategories' => $riskcategories,
            'asets' => $asets,
            'elementActive' => 'evaluate',
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
    }

    public function createKeterangan()
    {
        $riskcategories = RiskCategories::all();
        $aset = AsetKritis::all();
        return view('risks.create_keterangan', ['riskcategories' => $riskcategories, 'aset' => $aset]);
    }

    public function editKeterangan(string $id)
    {
        $kelemahan_aset = KelemahanAsets::find($id);
        $riskcategories = RiskCategories::all();
        $aset = AsetKritis::all();
        return view('risks.edit_keterangan', ['kelemahan_aset' => $kelemahan_aset, 'riskcategories' => $riskcategories, 'aset' => $aset]);
    }
}
