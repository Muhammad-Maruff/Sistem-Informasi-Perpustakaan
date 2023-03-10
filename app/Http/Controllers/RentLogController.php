<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index(Request $request)
    {
        $rent_logs = RentLogs::with(['user', 'book'])->get();
        return view('rentlog', ['rent_logs' => $rent_logs]);
    }
}
