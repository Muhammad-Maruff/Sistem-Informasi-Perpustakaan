@extends('layouts.mainLayout')
@section('title','Book List')

@section('content')
    <form action="" method="get">
      <div class="row">
        <div class="col-12 col-sm-6">
          <select name="category" class="form-select" aria-label="Default select example">
            <option selected disabled>Choose Category</option>
            @foreach ($category as $item)
             <option value={{ $item->id }}>{{ $item->name }}</option>
            @endforeach
           
          </select>
        </div>

        <div class="col-12 col-sm-6">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search book's title" aria-label="Username" aria-describedby="basic-addon1" name="title">
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </div>
      </div>
    </form>

   <div class="row mt-5">
        @foreach ($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
          <div class="card h-100">
              <img src="{{ $book->cover != null ? asset('storage/cover/'.$book->cover) : asset('images/cover_not_found.jpg')}}" class="card-img-top" alt="..." width="150px" height="260px" draggable="false">
              <div class="card-body">
                <h5 class="card-title">{{ $book->book_code }}</h5>
                <p class="card-text" style="font-weight:bold">{{ $book->title }}</p>
                <p class="card-text text-end fw-bold {{ $book->status == 'in stock' ? 'text-success' : 'text-danger'}}" >{{ $book->status }}</p>
              </div>
            </div>
            
      </div>
      @endforeach
   </div>
@endsection