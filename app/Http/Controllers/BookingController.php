<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // booking::withTrashed()->get()->dd(); نحن نحذف السجللات من الواجهة فقط وتبقى في قاعدة البيانات,هذه التعليمة تظهر لنا ذلك في حقل ال deleted at
        // $bookingss= $bookings->links();
        // $bookings= Booking::paginate(3);
        // dd($bookings);

         $booking=DB::table('bookings')->get();
         return view('bookings.index')
         ->with('booking', $booking);
        //  ->with('bookings', $bookings);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=DB::table('users')->get()->pluck('name','id');
        $rooms=DB::table('rooms')->get()->pluck('number','id');
        return view ('bookings.create')
        ->  with('users', $users)
        ->  with('booking', (new Booking()))
        -> with('rooms', $rooms);

    }  
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $booking=booking::create($request->input());
    //    $id=DB::table('bookings')->insertGetid([
    //     'room_id'=> $request->input('room_id'),
    //     'start'=> $request->input('start'),
    //     'end'=> $request->input('end'),
    //     'is_reservation'=> $request->input('is_reservation', false),
    //     'is_paid'=> $request->input('is_paid', false),
    //     'notes'=> $request->input('notes'),
    //    ]);
       DB::table('bookings_users')->insert ([
        'booking_id'=> $booking->id,
        'user_id'=>$request->input('user_id'),
       ]);

      return redirect()->action('App\Http\Controllers\BookingController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', ['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $users=DB::table('users')->get()->pluck('name','id')->prepend('');
        $rooms=DB::table('rooms')->get()->pluck('number','id')->prepend('');
        $bookingsUser=DB::table('bookings_users')->get()->where('booking_id',$booking->id)->first();
        // dd($users,$rooms,$bookingsUser,$booking);
        return view ('bookings.edit')
        ->  with('users', $users)
        -> with('rooms', $rooms)
        -> with('bookings_user', $bookingsUser)
        -> with('booking', $booking);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->fill($request->input());
        $booking->save();
        // DB::table('bookings')->where('id',$booking->id)
        // ->update([
        //     'room_id'=> $request->input('room_id'),
        //     'start'=> $request->input('start'),
        //     'end'=> $request->input('end'),
        //     'is_reservation'=> $request->input('is_reservation', false),
        //     'is_paid'=> $request->input('is_paid', false),
        //     'notes'=> $request->input('notes'),
        //    ]);
           DB::table('bookings_users')
           ->where('booking_id',$booking->id)
           -> update ([
            'user_id'=>$request->input('user_id'),
           ]);
    
          return redirect()->action('App\Http\Controllers\BookingController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        // dd($booking);
        DB::table('bookings_users')->where('booking_id',$booking->id)->delete();
        $booking->delete();
        // DB::table('bookings')->where('id',$booking->id)->delete();
        return redirect()->action('App\Http\Controllers\BookingController@index');
       
    }
}
