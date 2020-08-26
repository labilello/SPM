<?php


namespace App\Http\Controllers\Auth;

use \App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function index() {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request) {

        if($request->get('password') != $request->get('password2')) {
            return back()->with([
                'type_status' => 'danger',
                'status' => 'Las claves no coinciden'
            ]);
        }

        $user = User::find($request->get('id'));
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return view('home');
    }
}
