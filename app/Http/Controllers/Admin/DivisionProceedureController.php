<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Proceedure;
use Illuminate\Http\Request;

class DivisionProceedureController extends Controller
{
    public function index()
    {
        $divisions = Division::with('proceedures')->get();
        $proceedures = Proceedure::all();
        return view('admin.divisions.proceedures', compact('divisions', 'proceedures'));
    }

    public function attach(Request $request)
    {
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'proceedure_ids' => 'array|required',
        ]);

        $division = Division::findOrFail($request->division_id);
        $division->proceedures()->syncWithoutDetaching($request->proceedure_ids);

        return back()->with('success', 'Procedures linked to Division successfully.');
    }

    public function detach(Request $request, Division $division, Proceedure $proceedure)
    {
        $division->proceedures()->detach($proceedure->id);
        return back()->with('success', 'Procedure unlinked from Division.');
    }
}
