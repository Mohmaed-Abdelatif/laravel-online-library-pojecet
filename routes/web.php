<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('books.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/books', [App\Http\Controllers\StudentController::class, 'index'])->name('books.index');
    Route::get('/books/{id}/borrow', [App\Http\Controllers\StudentController::class, 'borrow'])->name('books.borrow');
    Route::get('/books/borrowed-books', [App\Http\Controllers\StudentController::class, 'borrowedBooks'])->name('books.borrowedBooks');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__.'/admin-auth.php';

route::get('/admin',function(){
    return to_route('admin.books.index');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/books', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books.index');
    Route::get('admin/books/create', [App\Http\Controllers\Admin\BookController::class, 'create'])->name('admin.books.create');
    Route::post('admin/books', [App\Http\Controllers\Admin\BookController::class, 'store'])->name('admin.books.store');
    Route::get('admin/books/{book}', [App\Http\Controllers\Admin\BookController::class, 'show'])->name('admin.books.show');
    Route::get('admin/books/{book}/edit', [App\Http\Controllers\Admin\BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('admin/books/{book}', [App\Http\Controllers\Admin\BookController::class, 'update'])->name('admin.books.update');
    Route::delete('admin/books/{book}', [App\Http\Controllers\Admin\BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('admin/borrowed-books', [App\Http\Controllers\Admin\BookController::class, 'getAllBorrowedBooks'])->name('admin.books.borrowedBooks');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/students', [App\Http\Controllers\Admin\StudentManagementController::class, 'index'])->name('admin.students.index');
    Route::get('admin/students/{id}', [App\Http\Controllers\Admin\StudentManagementController::class, 'show'])->name('admin.students.show');
    Route::get('admin/students/search', [App\Http\Controllers\Admin\StudentManagementController::class, 'search'])->name('admin.students.search');
});





