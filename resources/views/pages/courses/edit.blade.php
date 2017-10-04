@extends('templates.master')

@section('title', 'Edit User')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h3 class="grey-text">Edit User</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    {{ Form::open(['route'=>'postEditCourse']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <div class="row">
                        <div class="col s12 m6 l6 input-field">
                            <label for="name-input">Name</label>
                            <input type="text" class="form-control" value="{{ $course->name }}" id="name-input" name="name" minlength="2"
                                   maxlength="45" required>
                        </div>
                        <div class="col s12 m6 l6 input-field">
                            <label for="slug-input">Slug</label>
                            <input type="text" class="form-control" id="slug-input" value="{{ $course->slug }}" name="slug" minlength="2"
                                   maxlength="45" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12 input-field">
                            <label for="description-input">Description</label>
                            <input type="text" class="form-control" id="description-input" value="{{ $course->description }}" name="description" minlength="2"
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