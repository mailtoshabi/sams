<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category; use App\Models\Division; use App\Models\Chapter; use App\Models\Formulation; use App\Models\Medicine; use App\Models\Disease; use App\Models\Proceedure;
use Illuminate\Support\Facades\View;

class AjaxController extends Controller {
    public function getCategoryFields($category_id){
        $category = Category::findOrFail($category_id);
        $html = '';
        // match by name or id — adapt to your Utility constants if available
        $name = strtolower($category->name);
        if (str_contains($name,'classical disease')) {
            $html = View::make('admin.content-items.partials._classical_fields', [
                'divisions'=>Division::all(),'chapters'=>Chapter::all(),'formulations'=>Formulation::all(),'medicines'=>Medicine::all()
            ])->render();
        } elseif (str_contains($name,'commercial') || str_contains($name,'proprietary')) {
            $html = View::make('admin.content-items.partials._medicine_fields', [
                'formulations'=>Formulation::all(),'medicines'=>Medicine::all()
            ])->render();
        } elseif (str_contains($name,'patent') || str_contains($name,'modern')) {
            $html = View::make('admin.content-items.partials._disease_fields', ['diseases'=>Disease::all()])->render();
        } elseif (str_contains($name,'ayurvedic')) {
            $html = View::make('admin.content-items.partials._proceedure_fields', ['divisions'=>Division::all(),'proceedures'=>Proceedure::all()])->render();
        } else {
            $html = '<div class="alert alert-secondary">No fields for this category</div>';
        }
        return response()->json(['status'=>true,'html'=>$html]);
    }
}
