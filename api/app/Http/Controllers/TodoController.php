<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }
}
