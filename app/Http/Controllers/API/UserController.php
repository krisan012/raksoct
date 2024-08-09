<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {

    }

    public function login()
    {

    }

    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
