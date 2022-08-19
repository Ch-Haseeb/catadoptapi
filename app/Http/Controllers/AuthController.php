<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->plainTextToken;
            $minutes = 2440;
            $timestamp = now()->addMinute($minutes);
            $expires_at = date('M d, Y H:i A', strtotime($timestamp));
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_at' => $expires_at,
                'data'=>$user
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials',
            ], 400);
        }
    }
    
    

    
    public function register(Request $request){
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6',
        //      'photo'=>'image|mimes:jpg,png',
        //      'phone' => 'required',
        //      'address'=>'required'
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'photo'=>$request->photo,
        //     'phone'=>$request->phone,
        //     'address'=>$request->address,
        // ]);

        // $token = Auth::login($user);
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'User created successfully',
        //     'user' => $user,
        //     'authorisation' => [
        //         'token' => $token,
        //         'type' => 'bearer',
        //     ]
        // ]);
         $request->validate([
              'name' => 'required|string|max:255',
                 'email' => 'required|string|email|max:255|unique:users',
                 'password' => 'required|string|min:6',
          
                 'phone' => 'required',
                  'address'=>'required'
             ]);
                 $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo'=>$request->photo,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);
   
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
   
        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        $token=  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
         return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user,
           
                'access_token' => $token,
                'type' => 'bearer',
            
        ]);
         
   
        // return $this->sendResponse($success, 'User register successfully.');

    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
