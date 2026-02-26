@extends('layouts.mainLayout')
@section('title','Rent Log')

@section('content')

    <h1>RentLog List</h1>
    <div class="mt-5">
        <x-rent-log-table :rentlog='$rent_logs'/>
    </div>
@endsection