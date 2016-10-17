<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

class StaffsController extends Controller
{
    public function __construct()
    {
        $this->middleware('staff');
    }

    public function index()
    {
        return "This is admin dashboard";
    }
}
