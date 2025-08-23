<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('can:isAdmin');
    }

    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }


}
