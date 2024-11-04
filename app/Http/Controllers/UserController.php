<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function manageUsers()
    {
        $this->authorize('viewManageUsers', auth()->user());
        return view('users.manage-users');
    }
}
