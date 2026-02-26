@extends('layouts.mainLayout')
@section('title', 'Delete Category')

@section('content')
    <div class="text-center d-flex align-items-center justify-content-center">
        <h2>Are you sure to delete category {{ $category->name }} ?</h2>
    </div>
    <div class="text-center d-flex justify-content-center">
        <a href="/categories" class="btn btn-danger">No</a>
        <a href="/category-destroy/{{ $category->slug }}" class="btn btn-success"">Yes</a>
    </div>
   
@endsection