@extends('adminlte::page')

@section('title', 'Student')

@section('content_header')
<h5>Add Teacher</h5>
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
                    <a href="{{ route('teachers.create') }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Teacher
                    </a>
                </div>

                <!-- Right Side Search -->
                <div class="card-tools">
                    <form action="{{ route('teachers.index') }}" method="GET">
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
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Qualification</th>
                            <th>Specialization</th>
                            <th>Experience</th>
                            <th>Joining Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                        <tr>
                            <td>
                                {{ $loop->iteration + ($teachers->currentPage() - 1) * $teachers->perPage() }}
                            </td>

                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->qualification }}</td>
                            <td>{{ $teacher->specialization }}</td>
                            <td>{{ $teacher->experience }} Years</td>
                            <td>{{ $teacher->joining_date }}</td>

                            <td>
                                <a href="{{ route('teachers.edit', $teacher->id) }}">
                                    Edit
                                </a>

                                |

                                <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Delete this teacher?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $teachers->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop