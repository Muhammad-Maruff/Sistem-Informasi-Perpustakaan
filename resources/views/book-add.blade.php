@extends('layouts.mainLayout')
@section('title', 'Add Book')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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
                <label for="code" class="col-sm-2 col-form-label fw-bold">Code</label>
        <div class="col-sm-10">
             <input type="text" name="book_code" class="form-control" id="code" placeholder="book code..." value="{{ old('book_code') }}">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="title" class="col-sm-2 col-form-label fw-bold">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" placeholder="book title..." value="{{ old('title') }}">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="image" class="col-sm-2 col-form-label fw-bold">Image</label>
        <div class="col-sm-10">
            <input type="file" name="image" class="form-control">
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="category" class="col-sm-2 col-form-label fw-bold">Category</label>
        <div class="col-sm-10">
            <select name="categories[]" id="category" class="form-select select-multiple" multiple>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach

            </select>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
        <button class="btn btn-add" type="submit">Save</button>
        </div>
      </form>

      <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script>
        $(document).ready(function() {
         $('.select-multiple').select2();
    });
      </script>
@endsection