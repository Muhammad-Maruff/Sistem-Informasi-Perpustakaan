@extends('layouts.mainLayout')
@section('title','Detail User')

@section('content')
<a href="/users" class="btn btn-back"><i class="bi bi-arrow-left-square-fill"></i></a>
    <h1 class="mt-5">Detail User</h1>
    
    <div class="mt-5 div text-center d-flex align-items-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <a href="/user-ban/{{ $user->slug }}" class="btn-view mt-2" style="padding:0; background-color:#e2d9dc"><i class="action-delete fa-solid fa-ban" style="font-size:50px"></i></a>
    @if ($user->status == 'inactive')
        <a href="/user-approve/{{ $user->slug }}" class="btn-view ms-3" style="border-radius: 50%; font-size:50px; padding:0; background-color:#e2d9dc"><i class="action-approve bi bi-check-circle-fill " style="color:#009933"></i></a>
    
    @endif
</div>


    <div class="mt-2">
        <table class="table table-striped table:hover table-bordered" style="border: 1px solid black">
            <tr>
                <th align="left" style="width: 50px">Username</th>
                <td>{{ $user->username }}</td>
            </tr>

            <tr>
                <th align="left" style="width: 50px">Phone</th>
                <td>{{ $user->phone }}</td>
            </tr>

            <tr>
                <th align="left" style="width: 50px">Address</th>
                <td>{{ $user->address }}</td>
            </tr>

            <tr>
                <th align="left" style="width: 50px">Status</th>
                <td>{{ $user->status }}</td>
            </tr>
        </table>
    </div>

    <div class="mt-5">
        <h2>User Rent Log</h2>
        <x-rent-log-table :rentlog='$rent_logs'/>
    </div>
@endsection