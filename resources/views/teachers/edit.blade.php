@extends('adminlte::page')

@section('title', 'Edit Teacher')

@section('content_header')
<h5>Edit Teacher</h5>
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

                <form method="POST"
                    action="{{ route('teachers.update', $teacher->id) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $teacher->name) }}"
                                placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $teacher->email) }}"
                                placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $teacher->phone) }}"
                                placeholder="Enter Phone">
                        </div>

                        <div class="form-group">
                            <label>Qualification</label>
                            <input type="text"
                                name="qualification"
                                class="form-control"
                                value="{{ old('qualification', $teacher->qualification) }}"
                                placeholder="Enter Qualification">
                        </div>

                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text"
                                name="specialization"
                                class="form-control"
                                value="{{ old('specialization', $teacher->specialization) }}"
                                placeholder="Enter Specialization">
                        </div>

                        <div class="form-group">
                            <label>Experience (Years)</label>
                            <input type="number"
                                name="experience"
                                class="form-control"
                                value="{{ old('experience', $teacher->experience) }}"
                                placeholder="Enter Experience">
                        </div>

                        <div class="form-group">
                            <label>Joining Date</label>
                            <input type="date"
                                name="joining_date"
                                class="form-control"
                                value="{{ old('joining_date', $teacher->joining_date) }}">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">

                                <option value="Male"
                                    {{ old('gender', $teacher->gender) == 'Male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="Female"
                                    {{ old('gender', $teacher->gender) == 'Female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="Other"
                                    {{ old('gender', $teacher->gender) == 'Other' ? 'selected' : '' }}>
                                    Other
                                </option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Current Photo</label><br>

                            @if($teacher->photo)
                            <img src="{{ asset('uploads/teachers/'.$teacher->photo) }}"
                                width="100"
                                class="mb-2">
                            @else
                            <p>No Photo Uploaded</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Change Profile Photo</label>
                            <input type="file"
                                name="photo"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address"
                                class="form-control"
                                rows="3">{{ old('address', $teacher->address) }}</textarea>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit"
                            class="btn btn-primary">
                            Update Teacher
                        </button>

                        <a href="{{ route('teachers.index') }}"
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