<?php

namespace App\Http\Controllers;

use App\Models\GardenTool;
use Illuminate\Http\Request;

class StoreFrontController extends Controller
{
    public function Index(Request $request) {

        //dd($request->searchInput);
        $GardenTools = $request->searchInput ? GardenTool::where('name', 'LIKE', '%'.$request->searchInput.'%')
        ->orWhere('description', 'LIKE', '%'.$request->searchInput.'%')->paginate(8) : GardenTool::paginate(8);

        // $GardenTools = [];
        return view('storefront.index', ['GardenTools' => $GardenTools]);

    }
}
