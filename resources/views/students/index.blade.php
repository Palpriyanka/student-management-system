@extends('adminlte::page')

@section('title', 'Student')

@section('content_header')
<h5>Add Student</h5>
@stop

@section('content')
<!-- /.row -->
<div class="row">
    <a href="{{ url('students/export/pdf') }}"
        class="btn btn-danger">
        Export PDF
    </a>

    <a href="{{ url('students/export/excel') }}"
        class="btn btn-success">
        Export Excel
    </a>
    <div class="col-12">
        <div class="card" style="padding:11px">
            <div class="card-header">

                <!-- Left Side Button -->
                <div class="float-left">
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Student
                    </a>
                </div>

                <!-- Right Side Search -->
                <div class="card-tools">
                    <form action="{{ route('students.index') }}" method="GET">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text"
                                name="table_search"
                                class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Class</th>
                            <th>Address</th>
                            @if(auth()->user()->role==1)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        {{$i=1;}}
                        @foreach($students as $student):
                        <tr>
                            <td>{{ $loop->iteration+ ($students->currentPage() - 1) * $students->perPage()}}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->schoolClass->class_name }}</td>
                            <td>{{$student->address}}</td>
                            @if(auth()->user()->role==1)
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}">
                                    Edit
                                </a>

                                |

                                <form action="{{ route('students.destroy', $student->id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Delete this student?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{$students->links()}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop