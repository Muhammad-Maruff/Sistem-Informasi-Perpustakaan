@extends('layouts.mainLayout')
@section('title', 'Book Return Page')


@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <h1 class="text-center mt-5">Book Return Form</h1>

    <div class="mt-5 div text-center d-flex align-items-center mx-auto">
        @if (session('message'))
            <div class="alert {{ session('alert-class') }}">
                {{ session('message') }}
            </div>
        @endif
    </div>


    <form action="book-return" method="post" class="mt-3 container w-50">
        @csrf

        <div class="form-group row">
            <label for="user" class="col-sm-2 col-form-label fw-bold">User</label>
            <div class="col-sm-10 mt-2">
            <select class="form-select inputbox" name="user_id" id="user_id">
                <option selected disabled>Choose User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user-> username}}</option>
                @endforeach
            
              </select>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="book" class="col-sm-2 col-form-label fw-bold">Book</label>
            <div class="col-sm-10 mt-2">
            <select class="form-select inputbox" name="book_id" id="book_id">
                <option selected disabled>Choose Book</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}"> {{ $book-> title}} ({{ $book->book_code }})</option>
                @endforeach
            
              </select>
            </div>
        </div>

        
        <div class="mt-3 d-flex justify-content-center">
        <button class="btn btn-add" type="submit">Submit</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
         $('.inputbox').select2();
    });
      </script>
@endsection