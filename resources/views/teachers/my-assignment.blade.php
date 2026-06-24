@extends('adminlte::page')

@section('title', 'My Profile')

@section('content')

<div class="card">



    <div class="card-body">




        <br>

        <h4>Assigned Classes & Subjects</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Class</th>
                    <th>Subjects</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $assignment->class_name }}</td>
                    <td>{{ $assignment->subject_name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">
                        No Assignment Found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection