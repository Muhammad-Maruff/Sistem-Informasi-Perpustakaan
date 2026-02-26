@extends('layouts.mainLayout')
@section('title','Users Banned')

@section('content')
    <a href="/users" class="btn btn-back"><i class="bi bi-arrow-left-square-fill"></i></a>
    <h1>Users Baned List</h1>

    <div class="mt-5 div text-center d-flex align-items-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>


    <div class="mt-2">
        <table class="table text-center justify-content-center align-items-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($bannedUsers as $user)
            <tbody>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @if ($user->phone)
                            {{ $user->phone }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="/user-restore/{{ $user->slug }}"><i class="bi bi-arrow-counterclockwise btn btn-restore"></i></a>
                    </td>
                </tr>
            </tbody>
            @endforeach

        </table>
    </div>
@endsection