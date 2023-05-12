<?php

namespace App\Http\Controllers;

class CountryViewController extends Controller
{
    /*
     * Show the countries view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('countries/index');
    }

    /**
     * Redirect to the add country form function
     *
     * @return void
     */
    public function add()
    {
        return view('countries/add');
    }

}
