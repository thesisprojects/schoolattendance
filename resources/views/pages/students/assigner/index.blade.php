@extends('templates.master')

@section('title', 'List of students')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m12 l12">
                    <a href="{{ route('getStudents') }}" class="right">Go back</a>
                </div>
            </div>
            <h4 class="grey-text">Basic Info:</h4>
            <hr>
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="grey-text"><label>Name:</label> {{ $student->first_name }} {{ $student->last_name }}</h5>
                </div>
                <div class="col s12 m6 l6">
                    <h5 class="grey-text"><label>Course:</label> {{ $student->course->name }}</h5>
                </div>
            </div>
            <h4 class="grey-text">Subjects:</h4>
            <hr>
            <div class="row">
                <div class="col s12 m12 l12">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Schedule</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($student->subjects->count())
                            @foreach($student->subjects as $subject)
                                <tr>
                                    <td>{{ ucfirst($subject->name) }}</td>
                                    <td>{{ ucfirst($subject->description) }}</td>
                                    <td>{{ strtoupper($subject->schedule) }}</td>
                                    <td>{{ strtoupper($subject->time_start) }}</td>
                                    <td>{{ strtoupper($subject->time_end) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <h3 class="red-text center">No subjects assigned to student.</h3>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    {{ Form::open(['route' => 'postAssignSubject']) }}
                    {{csrf_field()}}
                    <input type="hidden" name="student" value="{{ $student->id }}">
                    <select name="subject" class="browser-default" required>
                        <option value="" disabled selected>Select a subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col s12 m12 l12 center">
                    <button type="submit" class="btn blue white-text lighten-2">Assign Selected Subject</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12" id="response-display">
            @include('snippets.dialog')
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection