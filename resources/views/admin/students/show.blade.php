@extends('admin.adminlayouts.app')

@section('content')
    <h1>Student Details</h1>

    @if(isset($student))
        <p><strong>Name:</strong> {{ $student->name }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>

        <h2>Borrowed Books</h2>
        @if($borrowedBooks->isEmpty())
            <p>No books borrowed by this student.</p>
        @else
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Borrowed At</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowedBooks as $borrowedBook)
                        <tr>
                            <td>{{ $borrowedBook->title }}</td>
                            <td>{{ $borrowedBook->author }}</td>
                            <td>{{ $borrowedBook->borrowed_at }}</td>
                            <td>{{ $borrowedBook->return_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        <p>No student found.</p>
    @endif
@endsection
