@extends('layouts.mainLayout')
@section('title','Book Deleted List')

@section('content')
<a href="/books" class="btn btn-back"><i class="bi bi-arrow-left-square-fill"></i></a>

    <h1 class="text-center">Book Deleted List</h1>

    <div class="mt-5 div text-center d-flex align-items-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    
    <div class>
        <table class="table text-center justify-content-center align-items-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    @if (Auth::user()->role_id == 1)
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            @foreach ($bookDeleted as $item)
            <tbody>
                
                <tr> 
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    @if (Auth::user()->role_id == 1)
                    <td >
                        <a href="/book-restore/{{ $item->slug }}"><i class="bi bi-arrow-counterclockwise btn btn-restore"></i></a>
                    </td>
                    @endif
                </tr>
                
            </tbody>
            @endforeach
        </table>
    </div>
@endsection