@extends('layout')
@section('title')
    {{$user->name}} profile
@endsection


@section('content')
  @include('errors')
    @if (auth()->user()!== null)
      @section('pro')
        <div class="nav-profile">
            <img src="{{asset("uploads/".auth()->user()->img)}}" class="rounded-circle m-auto" alt="profile">
        </div>
      @endsection 
    @endif
  @if (request()->session()->has('message_sent'))
        <div class="alert alert-success">{{request()->session()->get('message_sent')}}</div>
    @endif
  <div class="card mb-3 text-center">
    <div class="card-body">
      <img src="{{asset("uploads/$user->img")}}" class="card-img-top w-25 rounded-circle m-auto" alt="...">
      <h5 class="card-title text-capitalize h1">{{$user->name}}</h5>
      <p class="card-text lead">This is a Bio about me.</p>
      <a class="btn btn-secondary" href="{{url("/messageForm/$user->id")}}">send message</a>
    </div>  
  </div>
@endsection