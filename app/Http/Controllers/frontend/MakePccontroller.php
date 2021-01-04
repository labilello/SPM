<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Makepc;

class MakePccontroller extends Controller
{
    public function lista() {
        return view('makepc\list', [
            'elements' => Makepc::orderBy('id', 'ASC')->paginate()
        ]);
    }

    public function nuevo() {
        return view('makepc\new');
    }

    public function editar(Makepc $makepc) { // GET

        return view('makepc\new', [
            'element' => $makepc
        ]);
    }

}
