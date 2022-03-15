<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Room;
use App\Models\User;
use App\Models\Category;
use App\Models\Activity;
use App\Models\CategoryActivity;
use App\Models\University;
use App\Models\DeletedEntity;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy("name", "asc")
        ->get();
        foreach($categories as $category){
            foreach($category->room as $room){
                $room->location;
            }

            $category->location;
        }
        $locations =Location::where("category_id",null)->get();
        $rooms =Room::where("category_id",null)->get();
        foreach($rooms as $room){
            $room->location;
            
        }
        $universities =University::all();
        
        return ['universities'=>$universities,'categories'=>$categories,'uncategorized'=>['locations'=>$locations,'rooms'=>$rooms]];
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
        $cate =new Category();
        $cate->Name =$request->name;
       $cate_saved= $cate->save();
        $activity = new CategoryActivity();
        //$activity->Category_id = $cate->id;
        // $activity->Performed_by = $request->user_id;
        $activity->id=$cate->id;
        $activity->Type =$request->type; //Edit
        $activity->Change = $request->activity_performed; //change will be changed to activity performed later on
        $act_saved = $activity->save();

        if($cate_saved && $act_saved){
            return ['status'=>'success'];
        }elseif($cate_saved && !$act_saved){
            $cate->delete();
            return ['status'=>'failed'];
        }elseif(!$cate_saved && $act_saved){
            $activity->delete();
            return ['status'=>'failed'];
        }
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
        $cate = Category::findorFail($id);
        $cate->Name =$request->name;
       $cate_saved= $cate->save();
        $activity = new CategoryActivity();
        //$activity->Category_id = $cate->id;
        // $activity->Performed_by = $request->user_id;
        $activity->Type =$request->type; //Edit
        $activity->Change ="updated ".$cate->name."to $request->name:";
        $activity->id =$cate->id; //Edit
        $act_saved = $activity->save();
        
        if($cate_saved && $act_saved){
            return ['status'=>'success'];
        }elseif($cate_saved && !$act_saved){
            $cate->delete();
            return ['status'=>'failed'];
        }elseif(!$cate_saved && $act_saved){
            $activity->delete();
            return ['status'=>'failed'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $cate = Category::findOrFail($id);
        // foreach($cate->location as $loc){
        //     $loc->category_id=null;
        //     $loc->save();
        // }
        
        $cate_deleted=$cate->delete();

        $activity = new DeletedEntity();
        //$activity->Category_id = $cate->id;
        // $activity->Performed_by = $request->user_id;
        $activity->Deleted_entity =$request->deleted; //Edit
        $act_saved = $activity->save();
        if($cate_deleted && $act_saved){
            return ['status'=>'success'];
        }elseif(!$cate_deleted && $act_saved){
            $activity->delete();
            return ['status'=>'failed'];
        }
    }
}
