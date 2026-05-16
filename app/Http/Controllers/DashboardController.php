<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sapi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTersedia = Sapi::where('status', 'Tersedia')->count();
        $totalTerjual = Sapi::where('status', 'Terjual')->count();
        $totalDipesan = Sapi::where('status', 'Booking')->count();
        return view('depan', compact('totalTersedia', 'totalTerjual', 'totalDipesan'));
    }
}