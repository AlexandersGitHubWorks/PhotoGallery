<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.has.table');
    }

    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('photos')->where('id', $id)->first();
        return view('user.show', compact('user'));
    }
}
