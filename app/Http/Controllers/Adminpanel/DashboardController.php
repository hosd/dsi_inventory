<?php

namespace App\Http\Controllers\Adminpanel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
	
    public function index()
    {
        $office_id = Auth::user()->office_id;
        return view('dashboard');
    }

}
