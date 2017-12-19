<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller

{

    public function __construct()

    {

       $this->middleware('guest', ['except' => 'destroy']);

    }


    public function create()

    {

        return view('sessions.create');

    }


    public function store()

    {

        // Try to authenticate the user. If not, redirect back.  If yes, sing in

        if (! auth()->attempt(request(['email', 'password']))) {

            return back()->withErrors([

                'message' => 'Please check your data and try again.'

            ]);

        }


        return redirect('/');

    }



    public function destroy()

    {

        auth()->logout();

        return redirect('/');

    }

}
