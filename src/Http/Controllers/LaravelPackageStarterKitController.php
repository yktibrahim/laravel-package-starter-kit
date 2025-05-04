<?php

namespace LaravelPackageStarterKit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaravelPackageStarterKitController extends Controller
{
    /**
     * Display the package main page.
     * Paketin ana sayfasını göster.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('laravelpackagestarterkit::index');
    }
} 