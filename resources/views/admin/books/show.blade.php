@extends('admin.adminlayouts.app')

@section('content')
    <h1>Book Details</h1>

    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Description:</strong> {{ $book->description }}</p>

    @if ($borrowerName)
        <h3>Currently Borrowed By:</h3>
        <p><strong>Name:</strong> {{ $borrowerName }}</p>
        <p><strong>Email:</strong> {{ $borrowerEmail }}</p>
    @else
        <p><strong>Status:</strong> Available</p>
    @endif
@endsection
