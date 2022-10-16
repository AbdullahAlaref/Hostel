<?php

namespace App\Http\Controllers;
use App\models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class ShowRoomsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rooms_(Request $request ,$roomType=null)
    {

    //    if(isset($roomType)){
    //     $rooms=room::where('room_type_id','!=', $roomType)->get(); طريقة تانية

    //    if($request->query('id')!==null){  طريقة اولى
    //     $rooms=$rooms->where('room_type_id', $request->query('id'));
    //    }
    //    else 
    //    $rooms=room::get();
        $rooms=room::byType($roomType)->get();
       return view('rooms.index',['rooms'=>$rooms]);
    //    return responce()->json($rooms);
    }
}
