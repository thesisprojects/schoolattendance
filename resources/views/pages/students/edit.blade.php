@extends('templates.master')

@section('title', 'Edit Student')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m12 l12">
                    <a href="{{ route('getStudents') }}" class="right">Go back</a>
                    <h3 class="grey-text">Edit Student</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    {{ Form::open(['route'=>'postEditStudent']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $student->id }}">
                    <div class="row">
                        <div class="col s12 m12 l12 input-field">
                            <label for="id-input">ID Number</label>
                            <input type="text" class="form-control" value="{{ $student->id_number }}" id="id-input" name="id_number" minlength="11"
                                   maxlength="11" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6 input-field">
                            <label for="name-input">First name</label>
                            <input type="text" class="form-control" value="{{ $student->first_name }}" id="firstname-input" name="first_name" minlength="2"
                                   maxlength="40" required>
                        </div>
                        <div class="col s12 m6 l6 input-field">
                            <label for="lastname-input">Last name</label>
                            <input type="text" class="form-control" id="lastname-input" value="{{ $student->last_name }}" name="last_name" minlength="2"
                                   maxlength="40" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6 input-field">
                            <label for="emergency-input">Emergency number</label>
                            <input type="text" class="form-control" id="emergency-input" value="{{ $student->parent_contact_number }}" name="parent_contact_number"
                                   minlength="11" maxlength="11" required>
                        </div>
                        <div class="col s12 m6 l6">
                            <label>Course</label>
                            <select name="course_id" class="browser-default" required>
                                <option value="{{ $student->course_id }}" selected>IT</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ ucwords($course->slug) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <label for="year-input">Start year</label>
                            <input type="date" class="form-control" id="year-input" value="{{ Carbon\Carbon::parse($student->start_year)->toDateString() }}" name="start_year" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                                <button class="btn" type="submit">Update</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col s12 m12 l12" id="response-display">
            @include('snippets.dialog')
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection