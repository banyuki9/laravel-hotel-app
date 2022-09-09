<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardfController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'rooms' => Rooms::all(),
        ]);

    }
}
