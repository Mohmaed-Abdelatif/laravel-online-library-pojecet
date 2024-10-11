<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        $books = Book::where('is_available', true)->get();
        return view('books.index', compact('books'));
    }

    public function borrowedBooks()
{
     // Get the authenticated user
     $user = Auth::user();

     // Get all books borrowed by the user
     $borrowedBooks = $user->borrowedBooks()->get(); // This retrieves all related books

     // Return the borrowed books, for example, to a view
     return view('books.borrowed_books', compact('borrowedBooks'));
}

    public function borrow($id) {
        $book = Book::findOrFail($id);

        if ($book->is_available) {
            BorrowedBook::create([
                'book_id' => $book->id,
                'user_id' =>  Auth::id(),
                'borrowed_at' => now(),
                'return_date' => now()->addDays(14),
            ]);

            $book->update(['is_available' => false]);

            return redirect()->route('books.index')->with('success', 'Book borrowed successfully!');
        }

        return redirect()->back()->with('error', 'Book is not available.');
    }
}
