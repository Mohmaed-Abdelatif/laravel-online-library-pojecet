@extends('admin.adminlayouts.app')
@section('title')
    All Students
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<form action="{{ route('admin.students.search') }}" method="GET">
    <label for="student_id">Student ID:</label>
    <input type="text" name="student_id" id="student_id" required>
    <button type="submit">Search</button>
</form>

<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
