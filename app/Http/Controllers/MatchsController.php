<?php

namespace App\Http\Controllers;

use App\Models\matchs;
use Illuminate\Http\Request;

class MatchsController extends Controller
{
   /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(matchs::class, 'match');
    }

    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $matchs =matchs::all();
        return view('viewmatchs')->with('matchs', $matchs);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(matchs $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(matchs $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, matchs $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(matchs $match)
    {
        //
    }

}
