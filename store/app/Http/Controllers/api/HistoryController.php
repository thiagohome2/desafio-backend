<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{

    public function all()
    {
        $history = History::all();
        return response()->json($history);
    }

    public function allbyid($clientid)
    {
        $history = History::where('client_id','=', trim($clientid))->get();
        return response()->json($history);
    }
}
