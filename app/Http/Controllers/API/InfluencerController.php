<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Influencer;
use App\Http\Resources\InfluencerResource;

class InfluencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Influencer::latest()->get();
        return response()->json([InfluencerResource::collection($data), 'Programs fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'tier' => 'required',
            'category' => 'required',
            'urlpict' => 'required',
            'verified' => 'required',
            'followers' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $influencer = Influencer::create([
            'username' => $request->username,
            'tier' => $request->tier,
            'category' => $request->category,
            'urlpict' => $request->urlpict,
            'verified' => $request->verified,
            'followers' => $request->followers,
            'engagement' => $request->engagement,
            'contact' => $request->contact,
            'ratecard' => $request->ratecard,
            'notes' => $request->notes,
         ]);
        
        return response()->json(['Program created successfully.', new InfluencerResource($influencer)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $influencer = Influencer::find($id);
        if (is_null($influencer)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new InfluencerResource($influencer)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Influencer $influencer)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'tier' => 'required',
            'category' => 'required',
            'urlpict' => 'required',
            'verified' => 'required',
            'followers' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }


        $influencer->username = $request->username;
        $influencer->tier = $request->tier;
        $influencer->category = $request->category;
        $influencer->urlpict = $request->urlpict;
        $influencer->verified = $request->verified;
        $influencer->followers = $request->followers;
        $influencer->engagement = $request->engagement;
        $influencer->contact = $request->contact;
        $influencer->ratecard = $request->ratecard;
        $influencer->notes = $request->notes;
        $influencer->save();
        
        return response()->json(['Program updated successfully.', new InfluencerResource($influencer)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Influencer $influencer)
    {
        $influencer->delete();

        return response()->json('Program deleted successfully');
    }
}