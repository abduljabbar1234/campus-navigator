<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Room;
use App\Models\User;
use App\Models\Category;
use App\Models\Activity;
use App\Models\RoomActivity;
use App\Models\CategoryActivity;
use App\Models\DeletedEntity;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $activities = Activity::all();
        // return $activities;

        $location_activities = DB::table('location_activities')->get();
        $room_activities = DB::table('room_activities')->get();

$category_activities = DB::table('category_activities')->get();
$deleted=DB::table('deleted_entities')->get();
    $all_activities=
       $location_activities->union($room_activities)->union($category_activities);
        return ['all_activities'=>$all_activities,'deleted'=>$deleted];
        
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_act = Activity::where('Performed_by',$id)->get();
        return $user_act;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
}
