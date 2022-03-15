<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use App\Models\Location;
use App\Models\Room;
use App\Models\Category;
use App\Models\RoomActivity;
use App\Models\CategoryActivity;
use App\Models\DeletedEntity;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkPassword(Request $request, $id)
    {
        $user =User::findOrFail($id);
        if(!Hash::check($request->currentPassword, $user->password)){
            return ["message"=>'These credentials do not match our records.'];
        }else{
            return ["message"=>'confirmed'];
        }
    }

    public function changePassword(Request $request, $id)
    {
        $user =User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return ["message"=>'success'];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->id = $request->user_id;
        $user->save();
        return['status'=>'success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::where('id', $id)->first();
        return response($user,200);
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
        $user =User::findOrFail($id);
        $user->name = $request->name;
        $user->password =Hash::make($request->password);
        $user->id = $request->user_id;
        if($user->save()){
            return ['status'=>'successful'];
        }else{
            return ['status'=>'failed'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['status'=>'successful'];
        
    }


    public function login(Request $request)
    {

        $user= User::where('id', $request->user_id)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ['message' => 'User Logged out'];
    }
}
