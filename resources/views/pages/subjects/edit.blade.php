@extends('templates.master')

@section('title', 'Edit Subject')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h3 class="grey-text">Edit Subject</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    {{ Form::open(['route'=>'postEditSubject']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $subject->id }}">
                    <div class="row">
                        <div class="col s12 m6 l6 input-field">
                            <label for="name-input">Name</label>
                            <input type="text" class="form-control" value="{{ $subject->name }}" id="name-input" name="name" minlength="2"
                                   maxlength="45" required>
                        </div>
                        <div class="col s12 m6 l6">
                            <label for="slug-input">Schedule</label>
                            <select name="schedule" class = "browser-default">
                                <option value="{{ $subject->schedule }}">{{ $subject->schedule }}</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="MW">MW</option>
                                <option value="MWF">MWF</option>
                                <option value="TTH">TTH</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 input-field">
                            <label for="description-input">Description</label>
                            <input type="text" class="form-control" value="{{ $subject->description }}" id="description-input" name="description" minlength="2"
                                   maxlength="45" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <label for="time_start-input">Start Time</label>
                            <input type="time" class="form-control" id="time_start-input" value="{{ $subject->time_start }}" name="time_start" required>
                        </div>
                        <div class="col s12 m6 l6">
                            <label for="time_end-input">End Time</label>
                            <input type="time" class="form-control" id="time_end-input" value="{{ $subject->time_end }}" name="time_end" minlength="2"
                                   maxlength="45" required>
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