@extends('layouts.mainLayout')
@section('title', 'Ban user')

@section('content')
    <div class="text-center d-flex align-items-center justify-content-center">
        <h2>Are you sure to ban user {{ $user->username }} ?</h2>
    </div>
    <div class="text-center d-flex justify-content-center">
        <a href="/users" class="btn btn-danger">No</a>
        <a href="/user-destroy/{{ $user->slug }}" class="btn btn-success"">Yes</a>
    </div>
   
@endsection