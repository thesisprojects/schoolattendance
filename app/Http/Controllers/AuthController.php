<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->intended(route('getDashboard'));
            } else {
                $request->session()->flash('autherror', 'Failed to login! Email and password does not match!');
                return redirect()->back();
            }
        } catch (Exception $exception) {
            $request->session()->flash('exception', $exception->getMessage());
            return redirect()->back();
        }

    }

    public function unauthenticate()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
