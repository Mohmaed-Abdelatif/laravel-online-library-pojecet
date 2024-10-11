@extends('layouts.app')
@section('title')
Borrowed Books
@endsection
@section('content')
    <h2>Borrowed Books</h2>

    <ul>
        @foreach ($borrowedBooks as $book)
            <li>{{ $book->title }} (Borrowed at: {{ $book->pivot->borrowed_at }}, Return by: {{ $book->pivot->return_date }})</li>
        @endforeach
    </ul>
@endsection
