@extends('layout')

@section('title')
    register
@endsection

@section('content')
    @include('errors')
    <h2 class="text-center text-capitalize">welcome to register form</h2>
    <form action="{{url('/register')}}" method="POST" enctype="multipart/form-data" class="w-75 mx-auto my-5 text-center">
        @csrf

        @if (request()->session()->has('taken'))
            
            <div class="alert alert-danger">{{request()->session()->get('taken')}}</div>

        @endif

        <input type="text" name="name" class="form-control my-2" placeholder="name">
        <input type="text" name="bio" placeholder="Bio.." class="form-control my-2">
        <input type="email" name="email" class="form-control my-2" placeholder="email">
        <input type="password" name="password" class="form-control my-2" placeholder="password">
        <input type="password" name="password_confirmation" class="form-control my-2" placeholder="confirm password">
        <input type="file" class="form-control my-2 w-25" name="img">
        <button type="submit" value="submit" class="btn btn-outline-secondary w-25 mt-2">register</button>
    </form>
@endsection