<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('book-rent', ['users' => $users, 'books' =>$books]);
    }

    public function add(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        if($book['status'] != 'in stock'){
            Session::flash('message', 'The book is not available');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        }
        else{
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if($count >= 3)
            {
                Session::flash('message', 'User has reach limit of books');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }
            else{
                try {
                    // process insert to rent_logs table
                    DB::beginTransaction();
                    RentLogs::create($request->all());
                    // process update book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();
        
                    Session::flash('message', 'Rent Book Successfully');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('book-rent');
        
                    } 
                    catch (\Throwable $th) {
                        DB::rollback();
                    }
            }
        }
    }

    public function returnBook()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('return-book', ['users' => $users, 'books' => $books]);
    }

    public function saveReturnBook(Request $request)
    {
       $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
       $rentData = $rent->first();
       $countData = $rent->count();
       $book = Book::findOrFail($request->book_id)->only('status');
       
       if($countData == 1){
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();
            $rentData->save();

            Session::flash('message', 'The book is return successfully !');
            Session::flash('alert-class', 'alert-success');
            return redirect('book-return');
       }
       else{
            Session::flash('message', 'The book is return failed !');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-return');
       }
    }
}
