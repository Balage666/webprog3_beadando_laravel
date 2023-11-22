<?php

namespace App\Http\Controllers;

use App\Models\GardenTool;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Index(Request $request)
    {

        $GardenTools = $request->searchInput ? GardenTool::where('name', 'LIKE', '%'.$request->searchInput.'%')
            ->orWhere('description', 'LIKE', '%'.$request->searchInput.'%')
            ->paginate(8) : GardenTool::paginate(8);

        // $GardenTools = [];
        return view('admin.index', ['GardenTools' => $GardenTools]);

    }
}
