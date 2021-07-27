@extends('layout')
@section('title')
    {{ $user->name }}
@endsection
@section('content')
    @if (auth()->user() !== null)
        @section('pro')
            <div class="nav-profile">
                <img src="{{ asset('uploads/' . auth()->user()->img) }}" alt="profile">
            </div>
        @endsection
    @endif
    <div class="card mb-3 text-center">
        {{-- <a class="btn button-success" href="{{url("/profile/edit/{$user->id}")}}"></a> --}}
        <div class="card-body">
            <img src="{{ asset("uploads/$user->img") }}" class="card-img-top w-25 rounded-circle m-auto" alt="...">
            <h5 class="card-title text-capitalize h1">{{ $user->name }}</h5>
            <p class="card-text lead">{{ $user->bio }}</p>
            <a href="{{ url("profile/edit/$user->id") }}" class="btn btn-secondary">Edit</a>
        </div>
    </div>
    <hr>
    <h4>inbox *({{ $user->messages()->count() }})</h4>
    @foreach ($user->messages as $message)
        <li class="row">
            <div class="col-md-6">
                <p> {{ $message->content }}</p>
            </div>
            <div class="col-md-4  text-center">
                <p> time: {{ \Carbon\Carbon::parse($message->created_at)->format('j F, Y H:m:s') }}</p>
            </div>
            <div class="col-md-2  text-center">
                <a href="{{ url('user/' . auth()->user()->id . "/delete/$message->id") }}"
                    class="btn btn-danger mt-1">Delete</a>
            </div>
        </li>
    @endforeach
    {{-- view pagination --}}
    {{-- <div class="d-flex align-items-center justify-content-center">
    <p>{{$messages->links()}}</p>
    </div> --}}
@endsection
