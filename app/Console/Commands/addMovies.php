<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Movie;
use App\Show;
use App\Seat;
use App\Event;
class addMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seed the scheduler table with movies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $movies = Movie::get();
        for($i=0;$i<$movies->count();$i++)
        {
            for($j=0;$j<6;$j++)
            {
                for($c=0;$c<3;$c++)
                {
                    $show = new Show;
                        $show->movie_id=$movies[$i]->id;
                        $show->hall_id=rand( 1 , 4 );
                        $show->event_id=rand( 1 , 4 );
                        $show->day=date('Y-m-d',time()+$j*24*60*60);
                        $show->save();             
                }
            }           
        }

        $chars=['A','B','C','D','E','F','G','H','I'];
        $shows = Show::where([['day','>=',date('Y-m-d',time())]])->get();
        for($a=0;$a<$shows->count();$a++){
            for($b=0;$b<6;$b++){
                $seat=new Seat;
                $seat->seat_num =$chars[rand(0,count($chars)-1)].rand(1,12);
                $seat->user_id = 1;
                $seat->show_id=$shows[$a]->id; 
                $seat->save();
            }            
        }
    }
}
