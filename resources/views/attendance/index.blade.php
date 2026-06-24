@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
<h5>My Attendence</h5>
@stop

@section('content')
<form action="{{ route('attendance.store') }}"
    method="POST">

    @csrf

    <table class="table table-bordered">

        <tr>
            <th>Student</th>
            <th>Status</th>
        </tr>

        @foreach($students as $student)

        <tr>

            <td>
                {{ $student->name }}
            </td>

            <td>

                <input type="hidden"
                    name="student_id[]"
                    value="{{ $student->id }}">

                <select name="status[]"
                    class="form-control">

                    <option value="Present">
                        Present
                    </option>

                    <option value="Absent">
                        Absent
                    </option>

                    <option value="Leave">
                        Leave
                    </option>

                </select>

            </td>

        </tr>

        @endforeach

    </table>

    <button class="btn btn-primary">
        Save Attendance
    </button>

</form>
@stop