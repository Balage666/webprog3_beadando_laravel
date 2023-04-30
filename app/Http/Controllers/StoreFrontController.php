<?php

namespace App\Http\Controllers;

use App\Models\GardenTool;
use Illuminate\Http\Request;

class StoreFrontController extends Controller
{
    public function Index() {

        $GardenTools = GardenTool::paginate(8);

        // $GardenTools = [];
        return view('storefront.index', ['GardenTools' => $GardenTools]);

    }
}
