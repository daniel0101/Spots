<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spots = Spot::latest()->get();
        return response()->json($spots,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //save images to cloudinary --later
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spot = Spot::findOrFail($id);
        return response()->json($spot,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * finds the User that created this particular Spot
     *
     * @return \Illuminate\Http\Response
     */
    public function user($id)
    {
       return response()->json(Spot::findOrFail($id)->user,200);
    }


    /**
     * finds the Location of a particular Spot
     *
     * @return \Illuminate\Http\Response
     */
    public function location($id)
    {
       return response()->json(Spot::findOrFail($id)->location,200);
    }
}
