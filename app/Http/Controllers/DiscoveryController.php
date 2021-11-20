<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscoveryController extends Controller
{
    public function index()
    {
        return Inertia::render('Discovery/Index');
    }
}
