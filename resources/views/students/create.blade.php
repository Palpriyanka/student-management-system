@extends('adminlte::page')

@section('title', 'Add Student')

@section('content_header')
<h5>Add Student</h5>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary">
                @if($errors->any())
                <div>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control"
                                placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="form-control"
                                placeholder="Enter Phone">
                        </div>

                        <div class="form-group">
                            <label>Class</label>

                            <select name="class_id" class="form-control">
                                <option value="">-- Select Class --</option>

                                @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="text"
                                name="age"
                                value="{{ old('age') }}"
                                class="form-control"
                                placeholder="Enter Age">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>

                                <option value="male"
                                    {{ old('gender') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female"
                                    {{ old('gender') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="other"
                                    {{ old('gender') == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Profile Photo</label>
                            <input type="file"
                                name="photo"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea
                                name="address"
                                id="address"
                                class="form-control"
                                rows="3">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Save Student
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@stop