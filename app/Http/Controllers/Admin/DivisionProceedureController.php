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

        Proceedure::whereIn('id', $request->proceedure_ids)->update(['division_id' => $request->division_id]);

        return back()->with('success', 'Procedures linked to Division successfully.');
    }

    public function detach(Request $request, Division $division, Proceedure $proceedure)
    {
        $proceedure->update(['division_id' => null]);
        return back()->with('success', 'Procedure unlinked from Division.');
    }
}
