@extends('admin.adminlayouts.app')

@section('content')
    <h1>All Borrowed Books</h1>

    @if ($borrowedBooks->isEmpty())
        <p>No books are currently borrowed.</p>
    @else
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Borrower's Name</th>
                    <th>Borrower's Email</th>
                    <th>Borrowed Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowedBooks as $borrowedBook)
                    <tr>
                        <td>{{ $borrowedBook->title }}</td>
                        <td>{{ $borrowedBook->author }}</td>
                        <td>{{ $borrowedBook->borrower_name }}</td>
                        <td>{{ $borrowedBook->borrower_email }}</td>
                        <td>{{ \Carbon\Carbon::parse($borrowedBook->borrowed_at)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($borrowedBook->return_date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
