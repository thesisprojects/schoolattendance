@extends('templates.master')

@section('title', 'List of students')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        {{ Form::open(['route'=>'postCreateStudent']) }}
        @component('components.modal', [
            'id' => 'create-student-modal',
            'title' => 'Create a student.',
            'buttons' => [
                [
                'title' => 'Create',
                'type' => 'submit',
                'class' => 'btn green darken-2 white-text'
                ],
                [
                'title' => 'Cancel',
                'type' => 'reset',
                'class' => 'modal-close btn red white-text'
                ]
            ],
        ])
            {{ csrf_field() }}
            <div class="row">
                <div class="col s12 m12 l12 input-field">
                    <label for="id-input">ID Number</label>
                    <input type="text" class="form-control" id="id-input" name="id_number" minlength="11"
                           maxlength="11" required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <label for="name-input">First name</label>
                    <input type="text" class="form-control" id="firstname-input" name="first_name" minlength="2"
                           maxlength="40" required>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <label for="lastname-input">Last name</label>
                    <input type="text" class="form-control" id="lastname-input" name="last_name" minlength="2"
                           maxlength="40" required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <label for="emergency-input">Emergency number</label>
                    <input type="text" class="form-control" id="emergency-input" name="parent_contact_number"
                           minlength="11" maxlength="11" required>
                </div>
                <div class="col s12 m6 l6">
                    <label>Course</label>
                    <select name="course_id" class="browser-default" required>
                        <option value="" selected disabled>Select a course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ ucwords($course->slug) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <label for="year-input">Start year</label>
                    <input type="date" class="form-control" id="year-input" name="start_year" required>
                </div>
            </div>
        @endcomponent
        {{ Form::close() }}
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i data-target="create-student-modal" class="large material-icons waves-effect modal-trigger">add</i>
            </a>
        </div>
        <div class="card-panel">
            <h4 class="grey-text">List of students</h4>
            <table class="table responsive-table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Emergency number</th>
                    <th>Date enrolled</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ ucfirst($student->first_name) }}</td>
                        <td>{{ ucfirst($student->last_name) }}</td>
                        <td>{{ $student->parent_contact_number }}</td>
                        <td>{{ $student->start_year }}</td>
                        <td>
                            @if(Auth::user()->hasPermission('assign subjects'))
                                <button onclick="window.location.assign('{{ route('getAssignSubjects', ['id' => $student->id]) }}')"
                                        class="btn btn-success text-white">Subjects
                                </button>
                            @endif
                        </td>
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditStudent', ['id' => $student->id]) }}')"
                                    class="btn btn-success text-white">Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $students->links('vendor.pagination.materialize') }}
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