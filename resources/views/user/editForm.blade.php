@extends('layout')

@section('title')
    Edit Profile
@endsection

@section('content')
 @if (auth()->user()!== null)
      @section('pro')
        <div class="nav-profile">
            <img src="{{asset("uploads/".auth()->user()->img)}}" class="rounded-circle m-auto" alt="profile">
        </div>
      @endsection 
    @endif
    @include('errors')
    <form action="{{url("/profile/update/$user->id")}}" method="POST" enctype="multipart/form-data"
         class="w-75 mx-auto my-5 text-center">
         @csrf
        <input type="text" name="name" class="form-control mt-2" placeholder="name" value="{{$user->name}}">
        <input type="password" name="password" class="form-control mt-2" placeholder="password">
        <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="confirm password">
        <input name="bio" class="form-control mt-2" value="{{$user->bio}}" placeholder="Bio">
        <input type="file" name="img" class="form-control w-25 mt-2 mx-auto">
        <button type="submit" value="submit" class="btn btn-outline-secondary w-25 mt-2">update</button>
    </form>
@endsection