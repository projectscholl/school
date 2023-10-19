<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        $log = Activity::orderBy('id', 'desc')->get();
        return view('admin.settings.logActivity', compact('log'));
    }
}
