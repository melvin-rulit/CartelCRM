<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update()
    {
        return view('profile.edit');
    }

    public function password()
    {
        return view('profile.edit');
    }
}
