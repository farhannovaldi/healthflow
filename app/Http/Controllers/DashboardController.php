<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengembalikan tampilan dashboard
        return view('dashboard');
    }
}
