@extends('layout')
@section('title')
    send message
@endsection
@section('content')
    @include('errors')

        @if (auth()->user() !== null)
            @section('pro')
            <div class="nav-profile">
                <img src="{{asset("uploads/".auth()->user()->img)}}" class="rounded-circle m-auto" alt="profile">
            </div>
            @endsection 
        @endif

    @if (request()->session()->has('message_sent'))
        <div class="alert alert-success">{{request()->session()->get('message_sent')}}</div>
        @endif
        <img src="{{asset("uploads/$user->img")}}" class="w-25 rounded-circle mx-auto d-block" alt="...">
        <h3 class="text-center text-capitalize">send Message to {{$user->name}}</h3>
    <form action="{{url("/message")}}" method="POST" class="w-75 mx-auto mt-4 text-center">
        @csrf
        <input name="user_id" type="hidden" value="{{$user->id}}">
        <textarea name="content" cols="30" rows="4" placeholder="Type Message..." class="form-control bg-transparent w-75 mx-auto"></textarea>
        <br>
        <button type="submit" value="submit" class="btn btn-outline-secondary w-25 mx-auto mt-2">Send</button>
    </form>
@endsection