@extends('layouts.mainLayout')
@section('title', 'Delete Book')

@section('content')
    <div class="text-center d-flex align-items-center justify-content-center">
        <h2>Are you sure to delete book {{ $book->title }} ?</h2>
    </div>
    <div class="text-center d-flex justify-content-center">
        <a href="/books" class="btn btn-danger">No</a>
        <a href="/book-destroy/{{ $book->slug }}" class="btn btn-success"">Yes</a>
    </div>
   
@endsection