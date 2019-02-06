<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot,App\SpotImage;
use Cloudder;
use Auth;

class SpotController extends Controller
{
    public function __construct(){
        
    }
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
        $request->validate([
            'location_id'=>'required',
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required|digits:11',
            'avatar'=>'required|image',
        ]);
        // dd(Auth::user()->id);
        // dd($request->all());
       $spot = Spot::create([
            'user_id'=>Auth::user()->id,
            'location_id'=>$request->location_id,
            'name'=>$request->name,
            'address'=>$request->address,
            'phone_no'=>$request->phone,
            'avatar'=>'',
       ]);
       //upload image to cloudinary here --cloudder laravel wrapper :)
       if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $result = $this->uploadImage($request->avatar,['spot',$request->name]);    
            $this->spotImage($spot,$result);     
        }          
       return response()->json(['message'=>'Resource created succesfully!'],200);
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
    
    public function uploadImage($filename,array $tags){
        $response = Cloudder::upload($filename,null,[],$tags);
        return (object) $response->getResult();
    }

    public function spotImage($spot, $result){
        // dd($result);
        return SpotImage::create([
                'spot_id'=>$spot->id,
                'publicId'=>$result->public_id,
                'image_url'=>$result->secure_url,
                'status'=>'uploaded'
            ]);
    }
}