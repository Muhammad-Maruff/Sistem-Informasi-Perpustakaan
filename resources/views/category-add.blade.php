@extends('layouts.mainLayout')
@section('title', 'Add Category')

@section('content')
    <a href="/categories" class="btn btn-back"><i class="bi bi-arrow-left-square-fill"></i></a>
    <h1 class="text-center mt-5">Add New Category</h1>

    <div class="text-center d-flex align-items-center">
        @if ($errors->any())
            <div class="alert alert-danger ">
                <ul>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form action="category-add" method="post" class="mt-5 container w-50">
        @csrf

        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" placeholder="category name...">
          </div>
        </div>
        <div class="mt-3 d-flex justify-content-center">
        <button class="btn btn-add" type="submit">Save</button>
        </div>
      </form>
@endsection