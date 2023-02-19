@extends('layouts.mainLayout')
@section('title','Category Edit')

@section('content')
    <a href="/categories" class="btn btn-back"><i class="bi bi-arrow-left-square-fill"></i></a>
    <h1 class="text-center mt-5">Edit Category</h1>

    <div class="mt-5 div text-center d-flex align-items-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <form action="/category-edit/{{ $categories->slug }}" method="post" class="mt-5 container w-50">
        @csrf
        @method('put')

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" value="{{ $categories->name }}" placeholder="category name...">
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button class="btn btn-add" type="submit">Save</button>
        </div>
    </form>
  @endsection
