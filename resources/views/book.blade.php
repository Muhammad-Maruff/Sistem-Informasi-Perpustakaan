@extends('layouts.mainLayout')
@section('title','Book')

@section('content')
    <h1>Book List</h1>

    @if (Auth::user()->role_id==1)
    <div class="mt-5 d-flex justify-content-end">
        <a href="/book-deleted" class="btn btn-primary btn-view"><i class="bi bi-eye-fill me-2"></i>Deleted Data</a>
        <a href="/book-add" class="btn btn-primary btn-add ms-3">+ Add New</a>
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
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                @if (Auth::user()->role_id == 1)
                <th>Action</th>    
                @endif
                
            </tr>
            </thead>

            @foreach ($books as $book)
            <tbody>
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $book->book_code }}</td>
                    <td class="align-middle">{{ $book->title }}</td>
                    <td>
                        @foreach ($book->categories as $category)
                            {{ $category->name }} <br> 
                        @endforeach
                    </td>
                    <td class="align-middle">{{ $book->status }}</td>
                    @if (Auth::user()->role_id == 1)
                    <td class="align-middle">
                        <a href="/book-edit/{{ $book->slug }}"><i class="action-edit bi bi-pencil-square"></i></a>
                        <a href="/book-delete/{{ $book->slug }}"><i class="action-delete bi bi-trash3-fill"></i></a>
                    </td>
                    @endif
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection