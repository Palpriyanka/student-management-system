@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
<h5>Edit Student</h5>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary">

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('students.update', $student->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $student->name) }}"
                                placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $student->email) }}"
                                placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $student->phone) }}"
                                placeholder="Enter Phone">
                        </div>

                        <div class="form-group">
                            <label>Course</label>
                            <input type="text"
                                name="course"
                                class="form-control"
                                value="{{ old('course', $student->course) }}"
                                placeholder="Enter Course">
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="text"
                                name="age"
                                class="form-control"
                                value="{{ old('age', $student->age) }}"
                                placeholder="Enter Age">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="male"
                                    {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female"
                                    {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="other"
                                    {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Current Photo</label><br>

                            @if($student->photo)
                            <img src="{{ asset('uploads/'.$student->photo) }}"
                                width="100"
                                class="mb-2">
                            @endif

                            <input type="file"
                                name="photo"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address"
                                class="form-control"
                                rows="3">{{ old('address', $student->address) }}</textarea>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Update Student
                        </button>

                        <a href="{{ route('students.index') }}"
                            class="btn btn-secondary">
                            Back
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
@stop