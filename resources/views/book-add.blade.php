@extends('layouts.mainLayout')
@section('title', 'Add Book')

@section('content')
    <a href="/books" class="btn btn-back"><i class="bi bi-arrow-left-square-fill"></i></a>
    <h1 class="text-center mt-5">Add New Book</h1>

    <div class="text-center d-flex align-items-center">
        @if ($errors->any())
            <div class="alert alert-danger" style="position: absolute">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form action="book-add" method="post" class="mt-5 container w-50" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label">Code</label>
        <div class="col-sm-10">
             <input type="text" name="book_code" class="form-control" id="code" placeholder="book code..." value="{{ old('book_code') }}">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="book title..." value="{{ old('title') }}">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
            <input type="file" name="image" class="form-control">
            </div>
        </div>


        <div class="mt-4 d-flex justify-content-center">
        <button class="btn btn-add" type="submit">Save</button>
        </div>
      </form>
@endsection