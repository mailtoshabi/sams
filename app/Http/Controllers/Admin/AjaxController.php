<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category; use App\Models\Division; use App\Models\Chapter; use App\Models\Formulation; use App\Models\Medicine;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class AjaxController extends Controller {
    public function divisions(Request $request)
    {
        $q = $request->input('q');
        $items = Division::query()
            ->when($q, fn($qb) => $qb->where('name', 'like', "%{$q}%"))
            ->orderBy('name')
            ->limit(30)
            ->get(['id', 'name']);

        $results = $items->map(fn($i) => ['id' => $i->id, 'text' => $i->name]);

        return response()->json(['results' => $results]);
    }

    public function chapters(Request $request)
    {
        $q = $request->input('q');
        $dependency = $request->input('dependency'); // division_id if passed

        $query = Chapter::query();
        if ($dependency) {
            $query->where('division_id', $dependency);
        }
        if ($q) {
            $query->where('name', 'like', "%{$q}%");
        }

        $items = $query->orderBy('name')->limit(30)->get(['id', 'name']);

        $results = $items->map(fn($i) => ['id' => $i->id, 'text' => $i->name]);

        return response()->json(['results' => $results]);
    }

    public function formulations(Request $request)
    {
        $q = $request->input('q');

        $items = Formulation::query()
            ->when($q, fn($qb) => $qb->where('name', 'like', "%{$q}%"))
            ->orderBy('name')
            ->limit(30)
            ->get(['id', 'name']);

        $results = $items->map(fn($i) => ['id' => $i->id, 'text' => $i->name]);

        return response()->json(['results' => $results]);
    }

    public function medicines(Request $request)
    {
        $q = $request->input('q');

        $items = Medicine::query()
            ->when($q, fn($qb) => $qb->where('name', 'like', "%{$q}%"))
            ->orderBy('name')
            ->limit(30)
            ->get(['id', 'name']);

        $results = $items->map(fn($i) => ['id' => $i->id, 'text' => $i->name]);

        return response()->json(['results' => $results]);
    }
}
