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

    @if ($user->status == 'inactive')
    <div class="mt-4 d-flex justify-content-end">
        <a href="/user-approve/{{ $user->slug }}" class="btn-view" style="border-radius: 50%; font-size:50px; padding:0; background-color:white"><i class="bi bi-check-circle-fill" style="color:#009933"></i></a>
    </div>
    @endif


    <div class="mt-2">
        <table class="table table-striped table:hover table-bordered">
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
@endsection