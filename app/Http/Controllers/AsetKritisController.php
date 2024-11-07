<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiskCategories;
use Illuminate\Support\Facades\Hash;
use App\Models\AsetKritis;

class AsetKritisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riskcategories = RiskCategories::all();
        return view('asets.create', ['riskcategories' => $riskcategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required',
            'name' => 'required',
        ]);

        AsetKritis::create($data);

        return redirect()->route('risks.index')->with('success', 'Asset inputed successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aset = AsetKritis::find($id);
        $riskcategories = RiskCategories::all();
        return view('asets.edit', ['aset' => $aset, 'riskcategories' => $riskcategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aset = AsetKritis::find($id);

        $data = $request->validate([
            'kategori_id' => 'required',
            'name' => 'required',
        ]);

        $aset->update($data);

        return redirect()->route('risks.index')->with('success', 'Aset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AsetKritis::find($id)->delete();
        return redirect()->route('risks.index')->with('success', 'Aset deleted successfully.');
    }
}
