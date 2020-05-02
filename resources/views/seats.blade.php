@extends('layouts.mapp')

@section('content')

<div class="fill"></div>

<hall  
    user_id='{{(auth()->user()) ?auth()->user()->id  : ''}}'
    date='{{$date}}'
    event_id='{{$event_id}}'
    halls='{{$halls}}'
    movie_id='{{$movie_id}}'
    >
</hall>

@endsection