@extends('adminlte::page')

@section('title', 'Add Teacher')

@section('content_header')
<h5>Add Teacher</h5>
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

                <form method="POST" action="{{ route('teachers.store') }}" enctype=" multipart/form-data">
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
                            <label>Qualification</label>
                            <input type="text"
                                name="qualification"
                                value="{{ old('qualification') }}"
                                class="form-control"
                                placeholder="Enter Qualification">
                        </div>

                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text"
                                name="specialization"
                                value="{{ old('specialization') }}"
                                class="form-control"
                                placeholder="Enter Specialization">
                        </div>

                        <div class="form-group">
                            <label>Experience (Years)</label>
                            <input type="number"
                                name="experience"
                                value="{{ old('experience') }}"
                                class="form-control"
                                placeholder="Enter Experience">
                        </div>

                        <div class="form-group">
                            <label>Joining Date</label>
                            <input type="date"
                                name="joining_date"
                                value="{{ old('joining_date') }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male'?'selected' :''}}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female'?'selected' :''}}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other'?'selected' :''}}>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Profile Photo</label>
                            <input type="file"
                                name="photo"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address"
                                class="form-control"
                                rows="3">{{ old('address')}}</textarea>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Save Teacher
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