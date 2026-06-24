@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

@if(auth()->user()->role == 1)

<div class="row">

    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3 id="studentCount">{{ $studentCount }}</h3>

                <p>Total Students</p>

            </div>

            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>

            <a href="{{ route('students.index') }}"
                class="small-box-footer">

                More Info
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>{{ $teacherCount }}</h3>

                <p>Total Teachers</p>

            </div>

            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>

            <a href="{{ route('teachers.index') }}"
                class="small-box-footer">

                More Info
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>

</div>

@endif
@if(auth()->user()->role == 2)

<h5>Teacher Dashboard</h5>

<a href="{{ route('teacher.profile') }}"
    class="btn btn-primary">
    My Profile
</a>
<a href="{{ route('teacher.assign') }}"
    class="btn btn-primary">
    My Assignment
</a>
<a href="{{ route('students.index') }}"
    class="btn btn-primary">
    My Students
</a>
<a href="{{ route('attendance.index') }}"
    class="btn btn-primary">
    Attendance
</a>
@endif



@if(auth()->user()->role == 3)

<h5>Students Dashboard</h5>

<a href="{{ route('students.subject') }}"
    class="btn btn-primary">
    My Subjects
</a>

@endif
@endsection






<script>
    function updateCounts() {
        fetch('/dashboard-counts')
            .then(response => response.json())
            .then(data => {
                document.getElementById('studentCount').innerText = data.students;
                document.getElementById('teacherCount').innerText = data.teachers;
            });
    }

    // Run immediately
    updateCounts();

    // Then every 5 seconds
    setInterval(updateCounts, 5000);
</script>