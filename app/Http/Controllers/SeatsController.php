<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Seat as SeatResources;
use App\Events\ReserveEvent;
use App\Show;
use App\Seat;

class SeatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($date,$event_id,$movie_id)
    {

        // dd(auth()->user());
        // dd(session());
        $halls = Show::join('halls',function($join) use ($date,$event_id){
            $join->on('shows.hall_id','=','halls.id')
            ->where([['shows.day', '=',$date],['shows.event_id','=',$event_id]]);            
        })
            ->select('halls.hall_name','halls.id')
            ->groupBy('halls.hall_name','halls.id')
            ->get();

        // dd($halls);
        return view('seats',[
            'date'=>$date,
            'event_id'=>$event_id,
            'halls'=>$halls,
            'movie_id'=>$movie_id
        ]);
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
        
        
        $data = request();

        $json_data = json_decode($data['data']);        

        $show_id = Show::where([
            ['event_id','=',$json_data->event_id],
            ['hall_id','=',$json_data->hall_id],
            ['movie_id','=',$json_data->movie_id],
            ['day','=',$json_data->day],
            ])
        ->select('id')
        ->first()->id;

        $channel= 'date_'.$json_data->day.'_event_id_'.$json_data->event_id.'_movie_id_'.$json_data->movie_id.'_hall_id_'.$json_data->movie_id;
        // dd($channel);

        $saved_num=0;

        for($i=0 ; $i<count($json_data->selected_seats) ; $i++){

            $seat = new Seat;
            $seat->show_id = $show_id;
            // $seat->user_id = 1;
            $seat->user_id = auth()->user()->id;
            $seat->seat_num = $json_data->selected_seats[$i];
            
            if($seat->save()){
                $saved_num++;
                $channel= 'date_'.$json_data->day.'_event_id_'.$json_data->event_id.'_movie_id_'.$json_data->movie_id.'_hall_id_'.$json_data->movie_id;
                broadcast(new ReserveEvent($channel, $json_data->selected_seats[$i]));
            }

        }
        
        return $saved_num;
    }

    
    public function show($date,$event_id,$movie_id,$hall_id)
    {
        $seats = Show::join('seats',function($join) use ($date,$event_id,$hall_id,$movie_id){
            $join->on('shows.id','=','seats.show_id')
            ->where([
                ['shows.day', '=',$date],
                ['shows.event_id','=',$event_id],                                
                ['shows.movie_id', '=',$movie_id],
                ['shows.hall_id', '=',$hall_id],
                ]);            
        })
            ->select('seat_num')
            ->groupBy('seat_num')
            ->get();

            // $seats = DB::raw("select * FROM seats join shows on shows.id = seats.show_id where shows.day = '2020-03-30' AND shows.event_id = 2 and shows.hall_id = 1 AND shows.movie_id = 2");
        
        return SeatResources::collection($seats);
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
}
