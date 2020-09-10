<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Movement;

class MovementController extends Controller
{
    public function index()
    {
        return view('reportes\movements', [
            'elements' => Movement::orderBy('created_at', 'desc')->paginate()
        ]);
    }
}
