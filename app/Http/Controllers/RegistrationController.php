<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegistrationRequest;
use App\Mail\Welcome;
use App\User;



class RegistrationController extends Controller

{

    public function create()

    {

        return view('registration.create');

    }


    public function store(RegistrationRequest $request)

    {

        // Create and save user
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);


        // Sign user in
        auth()->login($user);

        \Mail::to($user)->send(new Welcome($user));


        // Redirect to the home page
        return redirect()->home();

    }

}
