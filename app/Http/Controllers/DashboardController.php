<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return back();
            // return redirect()->route('dashboard');
            //  return view('pages.auth.login');
        }

        $totalTersedia = Sapi::where('status', 'Tersedia')->count();
        $totalTerjual = Sapi::where('status', 'Terjual')->count();
        $totalDipesan = Sapi::where('status', 'Booking')->count();
        return view('depan', compact('totalTersedia', 'totalTerjual', 'totalDipesan'));
    }
}
