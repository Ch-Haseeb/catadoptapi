<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use Validator;

class CatApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Cat::paginate(2);

        return response()->json([
            "status" => true,
            "message" => "Cat Data",
            "data" => $products
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
            'name' => 'required',
            'color' => 'required',
            'breed' => 'required',
            'DOB' => 'required',
            'features' => 'required',
            'picture' => 'image|mimes:jpg,png',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs Try Again',
                'error' => $validator->errors()
            ]);
        }
        // $request_data['user_id']='null';
        $path = $request->file('picture')->store('public/images');
        $request_data['picture']=$path;

        $cat = Cat::create($request_data);

        return response()->json([
            "status" => true,
            "message" => "Product created successfully.",
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

    public function adopt(Request $request, $id)
    {
        $id = Cat::find($id);
        // $chk=auth()->user()->id;
        // $id['user_id']=$chk;

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data Find',
        //     'data'=>$id,
        //     'data'=>$chk


        // ]);
        if ($id) {
                if($id->user_id){
                return response()->json([
                    'status' => false,
                    'message' => 'Sorry this cat already adopt another user you can adopt any else cat',
                ]);
            } else {
                $chk = auth()->user()->id;
                $id->user_id = $chk;
                $id->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Congratulation You adopted successfully that cat',
                    'data' => $id,
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sorry Data not Found'

            ]);
        }
    }
}
