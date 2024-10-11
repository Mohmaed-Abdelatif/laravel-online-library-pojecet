<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BorrowedBook;

class StudentManagementController extends Controller
{
    // View all students
    public function index() {
        $students = User::all();
        return view('admin.students.index', compact('students'));
    }

    // Search for a student by ID
    public function search(Request $request) {
        $studentId = (int) $request->input('student_id');
        $student = User::find($studentId);
        // if (!$student) {
        //     return redirect()->back()->withErrors(['Student not found.']);
        // }
        // return redirect()->route('admin.students.show', $studentId);
        $borrowedBooks = BorrowedBook::where('user_id', $student->id)
        ->join('books', 'borrowed_books.book_id', '=', 'books.id')
        ->select('books.title', 'books.author', 'borrowed_books.borrowed_at', 'borrowed_books.return_date')
        ->get();

        return view('admin.students.details', ['student'=>$student , 'borrowedBooks'=>$borrowedBooks]);
    }

    public function show($id) {
        $student = User::find(id: $id);

        // if (!$student) {
        //     return redirect()->back()->withErrors(['Student not found.']);
        // }

        $borrowedBooks = BorrowedBook::where('user_id', $student->id)
            ->join('books', 'borrowed_books.book_id', '=', 'books.id')
            ->select('books.title', 'books.author', 'borrowed_books.borrowed_at', 'borrowed_books.return_date')
            ->get();

        return view('admin.students.show', compact('student', 'borrowedBooks'));
    }
}
