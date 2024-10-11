@extends('layouts.app')
@section('title')
    All box
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
                    <a href="{{route('books.borrow', $book->id)}}" class="btn btn-info">Borrow</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
