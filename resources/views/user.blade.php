@extends('layouts.mainLayout')
@section('title','User')

@section('content')
    <h1>User List</h1>

    @if (Auth::user()->role_id==1)
    <div class="mt-4 d-flex justify-content-end">
        <a href="/user-banned" class="btn btn-primary btn-view"><i class="bi bi-eye-fill me-2"></i>Banned User</a>
        <a href="/registered-users" class="btn btn-primary btn-add ms-3"><i class="bi bi-eye-fill me-2"></i>Registered User</a>
    </div>
    @endif

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
            @foreach ($users as $user)
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
                        <a href="user-detail/{{ $user->slug }}"><i class="action-edit bi bi-eye-fill"></i></a>
                        <a href="user-ban/{{ $user->slug }}"><i class="action-delete fa-solid fa-ban"></i></a>
                    </td>
                </tr>
            </tbody>
            @endforeach

        </table>
    </div>
@endsection