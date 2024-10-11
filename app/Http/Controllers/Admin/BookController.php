<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
// use illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        Book::create($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Check if the book is currently borrowed (return_date is in the future)
        $borrowedRecord = DB::table('borrowed_books')
            ->where('book_id', $book->id)
            ->where('return_date', '>', now()) // Check if return_date is in the future
            ->first();

        // If the book is borrowed, get the borrower information
        if ($borrowedRecord) {
            $borrower = User::find($borrowedRecord->user_id);

            // Return the borrower's name and email along with the book details
            return view('admin.books.show', [
                'book' => $book,
                'borrowerName' => $borrower->name,
                'borrowerEmail' => $borrower->email
            ]);
        }

        // If the book is not borrowed, just return the book details
        return view('admin.books.show', [
            'book' => $book,
            'borrowerName' => null, // No borrower
            'borrowerEmail' => null
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        $book->update($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }

    public function getAllBorrowedBooks()
    {
        // Query to get all borrowed books where the return date is in the future
        $borrowedBooks = DB::table('borrowed_books')
            ->join('books', 'borrowed_books.book_id', '=', 'books.id')
            ->join('users', 'borrowed_books.user_id', '=', 'users.id')
            ->where('borrowed_books.return_date', '>', now()) // Only include books that are still borrowed
            ->select('books.title', 'books.author', 'users.name as borrower_name', 'users.email as borrower_email', 'borrowed_books.borrowed_at', 'borrowed_books.return_date')
            ->get();


        // Return the borrowed books, for example, to a view
        return view('admin.books.borrowed_books', compact('borrowedBooks'));
    }
}
