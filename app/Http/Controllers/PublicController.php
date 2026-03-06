<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Check if categories table exists
            if (!Schema::hasTable('categories')) {
                return view('errors.database-setup', [
                    'message' => 'Tabel categories belum ada. Silakan jalankan migration terlebih dahulu.'
                ]);
            }

            $category = Category::all();
            
            if ($request->category){
                $books = Book::whereHas('categories', function($q) use($request){
                    $q->where('categories.id', $request->category);
                })->get();
            }
            else if ($request->title){
                $books = Book::where('title', 'like', '%' .$request->title.'%')->get();
            }
            else{
                $books = Book::all();
            }
            
            return view('book-list', ['books' => $books, 'category' => $category]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Check if it's a table doesn't exist error
            if (str_contains($e->getMessage(), "doesn't exist") || str_contains($e->getMessage(), "Unknown table")) {
                return view('errors.database-setup', [
                    'message' => 'Database belum di-setup dengan benar. Silakan jalankan migration terlebih dahulu.'
                ]);
            }
            
            // Re-throw other database errors
            throw $e;
        }
    }
}
