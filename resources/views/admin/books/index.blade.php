@extends('admin.adminlayouts.app')
@section('title')
All books
@endsection
@section('content')
    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Available</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{($book->is_available == 1 ? 'Available' : 'Not Available')}}</td>
                <td>
                    <a href="{{route('admin.books.show', $book->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('admin.books.edit', $book->id)}}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{route('admin.books.destroy',$book->id)}}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
