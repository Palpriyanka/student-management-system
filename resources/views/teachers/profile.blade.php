@extends('adminlte::page')

@section('title', 'My Profile')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>My Profile</h3>
    </div>

    <div class="card-body">

        @if($teacher->photo)

        <img src="{{ asset('uploads/'.$teacher->photo) }}"
            width="120"
            class="mb-3">

        @endif

        <table class="table table-bordered">

            <tr>
                <th>Name</th>
                <td>
                    {{ $teacher->name }}
                    {{ $teacher->last_name }}
                </td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $teacher->email }}</td>
            </tr>

            <tr>
                <th>Mobile</th>
                <td>{{ $teacher->phone }}</td>
            </tr>

            <tr>
                <th>Gender</th>
                <td>{{ $teacher->gender }}</td>
            </tr>

            <tr>
                <th>Qualification</th>
                <td>{{ $teacher->qualification }}</td>
            </tr>

            <tr>
                <th>Experience</th>
                <td>{{ $teacher->experience }}</td>
            </tr>

            <tr>
                <th>Address</th>
                <td>{{ $teacher->address }}</td>
            </tr>

        </table>

    </div>

</div>

@endsection