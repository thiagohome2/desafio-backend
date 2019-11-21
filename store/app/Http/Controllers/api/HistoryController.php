<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function all()
    {
        return "Ta legal";
    }

    public function allbyid($clientid)
    {
        return "opaa -> ".$clientid;
    }
}
