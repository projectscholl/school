<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        $log = Activity::latest()->paginate(10);
        return view('admin.settings.logActivity', compact('log'));
    }
}
