@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
<h5>My Subjects</h5>
@stop

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Teacher</th>
        </tr>
    </thead>
    <tbody>
        @forelse($subjects as $subject)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $subject->class_name }}</td>
            <td>{{ $subject->subject_name }}</td>
            <td>{{ $subject->name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">
                No Subjects Found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@stop