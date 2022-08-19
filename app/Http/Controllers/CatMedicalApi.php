<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medical_History;
use App\Models\Cat;
use Validator;

class CatMedicalApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medical = Medical_History::all();

        return response()->json([
            "status" => true,
            "message" => "Medical data of cat",
            "data" => $medical
        ]);
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
        $request_data = $request->all();

        $validator = Validator::make($request_data, [
            'medical_detail' => 'required',
            'date' => 'required',
            'dr_name' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs Try Again',
                'error' => $validator->errors()
            ]);
        }
        // $request_data['user_id']='null';
        $cat = Medical_History::create($request_data);

        return response()->json([
            "status" => true,
            "message" => "Successfully added Medical data of cat",
            "data" => $cat
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function getdata($id){
        $cat=Cat::find($id);
        $data=$cat->medical_history;
        return response()->json([
            "status" => true,
            "message" => "Successfully Find medical history",
            "data" => $cat
        ]);


    }
}
