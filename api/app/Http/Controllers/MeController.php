<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class MeController extends Controller
{
    public function index()
    {
        return new UserResource(auth()->user());
    }
}
