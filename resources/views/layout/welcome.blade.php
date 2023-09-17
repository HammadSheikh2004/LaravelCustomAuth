@extends('layout.app')
@section('title','Welcome Page')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-primary" href="{{ route('profile') }}">Update Profile</a>
                <p>Hello, {{ $userInfo->name }}</p>
            </div>
        </div>
    </div>
@endsection