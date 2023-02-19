@extends('layouts.mainLayout')
@section('title','Category')

@section('content')
    <h1 class="text-center">Category List</h1>
    @if (Auth::user()->role_id==1)
    <div class="mt-4 d-flex justify-content-end">
        <a href="/category-deleted" class="btn btn-primary btn-view"><i class="bi bi-eye-fill me-2"></i>Deleted Data</a>
        <a href="/category-add" class="btn btn-primary btn-add ms-3">+ Add New</a>
    </div>
    @endif

    <div class="mt-5 div text-center d-flex align-items-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    
    <div class>
        <table class="table text-center justify-content-center align-items-center mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    @if (Auth::user()->role_id == 1)
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            @foreach ($categories as $item)
            <tbody>
                
                <tr> 
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    @if (Auth::user()->role_id == 1)
                    <td >
                        <a href="category-edit/{{ $item->slug }}"><i class="action-edit bi bi-pencil-square"></i></a>
                        <a href="category-delete/{{ $item->slug }}"><i class="action-delete bi bi-trash3-fill"></i></a>
                    </td>
                    @endif
                </tr>
                
            </tbody>
            @endforeach
        </table>
    </div>
@endsection