<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use App\Models\RiskCategories;
use App\Http\Requests\RiskRequest;
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

    public function index() {
        $risks = Risk::all();
        $riskcategories = RiskCategories::all();
        return view('risks.index', ['risks' => $risks, 'riskcategories' => $riskcategories, 'elementActive' => 'risk']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riskcategories = RiskCategories::all();
        return view('risks.create', ['riskcategories' => $riskcategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $risk = $request->validate([
            'kategori_id' => 'required',
            'aset_kritis' => 'required',
            'risiko' => 'required',
            'penyebab' => 'required',
            'dampak' => 'required',
            'severity' => 'required',
            'occurence' => 'required',
            'detection' => 'required',
            'rpn_level' => 'required',
        ]);
        
        $risk['rpn'] = $risk['severity']*$risk['occurence']*$risk['detection'];


        Risk::create($risk);

        return redirect()->route('risks.index')->with('success', 'Risk inputed successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $risk = Risk::find($id);
        return view('risks.edit', compact('risk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $risk = Risk::find($id);

        $data = $request->validate([
            'kategori_risiko' => 'required',
            'aset_kritis' => 'required',
            'risiko' => 'required',
            'penyebab' => 'required',
            'dampak' => 'required',
            'severity' => 'required',
            'occurence' => 'required',
            'detection' => 'required',
            'rpn_level' => 'required',
        ]);

        $data['rpn'] = $data['severity']*$data['occurence']*$data['detection'];

        $risk->update($data);

        return redirect()->route('risks.index')->with('success', 'Risk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Risk::find($id)->delete();
        return redirect()->route('risks.index')->with('success', 'Risk deleted successfully.');
    }
}
