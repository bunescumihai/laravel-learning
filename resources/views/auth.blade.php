@extends('layouts.base')

@section('title','Authentication')

@section('content')
    <div class="col-4 mt-3">
        <form action="{{route('login')}}" method="post">
            @csrf
            <div>
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="enter your email">
            </div>

            <div class="mt-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" name="password" type="password" id="password">
            </div>

            @if($errors->has('invalid_credentials'))
                <p class="text-danger mt-3"> {{$errors->first('invalid_credentials')}}</p>
            @endif

            <button class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
