<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index()
    {
        return view('reportes\movements', [
            'elements' => Movement::paginate()
        ]);
    }
}
