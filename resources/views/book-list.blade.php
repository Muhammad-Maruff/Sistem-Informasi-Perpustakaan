@extends('layouts.mainLayout')
@section('title','Book List')

@section('content')
   <div class="row">
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