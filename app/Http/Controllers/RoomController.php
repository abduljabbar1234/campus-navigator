<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Room;
use App\Models\User;
use App\Models\Category;
use App\Models\Activity;
use App\Models\RoomActivity;
use App\Models\CategoryActivity;
use App\Models\DeletedEntity;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms =Room::where("category_id",null)->get();
        foreach($rooms as $room){
            $room->location;
            
        }
        return $rooms;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $room=Room::findOrFail($id);
        $room->location;
        return $room;
    }
    // Get list of rooms for a location
    public function roomList($id)
    {
        
        $room=Room::where('location_id',$id)->get();;
        return $room;
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
        $room =Room::findOrFail($id);
        $room->Room_no = $request->room_num;
            $room->Desc = $request->desc;
            $room->Floor = $request->floor;
            $room->room_name = $request->room_name;
            $room->category_id = $request->rcategory;
            $room->location_id = $request->location_id;

            $room_saved =$room->save();
        $activity = new RoomActivity();

        $activity->id = $request->room_num;
        $activity->Type =$request->type; //edit
        $activity->Change = "updated ".$room->Room_no."to: Room_no: ".$request->room_num.", Room_name: ".$request->room_name.", Desc: ".$request->desc.", Floor: ".$request->floor.", Category_id: ".$request->category_id.", Location_id: ".$request->location_id; //change will be changed to activity performed later on
        $act_saved = $activity->save();

       
            
            
          return ['status'=>'success'];
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        $activity = new DeletedEntity();
        //$activity->Category_id = $cate->id;
        // $activity->Performed_by = $request->user_id;
        $activity->Deleted_entity =$request->input('deleted'); //Edit
        $act_saved=$activity->save();
       
        
            
          return ['status'=>'success'];
      
    
    }

    public function approve($id)
    {
        
        $room = Room::findOrFail($id);
        $room->status = "approved";
    
        $room->save();
       
          return ['status'=>'success'];
       

    }
}
