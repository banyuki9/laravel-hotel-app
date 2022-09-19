<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardfController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'rooms' => Room::all(),
        ]);

    }
}
