@extends('layout')

@section('title')
    login
@endsection

@section('content')
@include('errors')

@if (request()->session()->has('error_msg'))

<div class="alert alert-danger">{{request()->session()->get('error_msg')}}</div>

@endif
<h1 class="text-center">login</h1>
<form action="{{url('/login')}}" method="POST" class="w-75 mx-auto my-5 text-center">
    @csrf
        <input type="email" name="email" class="form-control my-2" placeholder="email">
        <input type="password" name="password" class="form-control my-2" placeholder="password">
        <button type="submit" value="submit" class="btn btn-outline-secondary w-25 mt-2">login</button>
    </form>
@endsection