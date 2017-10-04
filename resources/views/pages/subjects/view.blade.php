@extends('templates.master')

@section('title', 'List of subjects')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        {{ Form::open(['route'=>'postCreateSubject']) }}
        @component('components.modal', [
            'id' => 'create-subjects-modal',
            'title' => 'Create a subject.',
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
                <div class="col s12 m6 l6 input-field">
                    <label for="cc_number-input">CC#</label>
                    <input type="text" class="form-control" id="cc_number-input" name="cc_number" minlength="2"
                           maxlength="45" required>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <label for="name-input">Name</label>
                    <input type="text" class="form-control" id="name-input" name="name" minlength="2"
                           maxlength="45" required>
                </div>
                <div class="col s12 m6 l6">
                    <label for="slug-input">Schedule</label>
                    <select name="schedule" class="browser-default">
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
                    <input type="text" class="form-control" id="description-input" name="description" minlength="2"
                           maxlength="45" required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6">
                    <label for="time_start-input">Start Time</label>
                    <input type="time" class="form-control" id="time_start-input" name="time_start" required>
                </div>
                <div class="col s12 m6 l6">
                    <label for="time_end-input">End Time</label>
                    <input type="time" class="form-control" id="time_end-input" name="time_end" minlength="2"
                           maxlength="45" required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 12">
                    <label for="time_start-input">Teacher</label>
                    <select name="assigned_teacher">
                        <option value="" disabled selected>Select assigned teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->last_name .', '. $teacher->first_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endcomponent
        {{ Form::close() }}
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i data-target="create-subjects-modal" class="large material-icons waves-effect modal-trigger">add</i>
            </a>
        </div>
        <div class="card-panel">
            <h4 class="grey-text">List of subjects</h4>
            <table class="table responsive-table">
                <thead>
                <tr>
                    <th>CC#</th>
                    <th>Name</th>
                    <th>Assigned Teacher</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ strtoupper($subject->cc_number) }}</td>
                        <td>{{ ucfirst($subject->name) }}</td>
                        <td>{{ ucfirst($subject->teacher->last_name . ", " . $subject->teacher->first_name) }}</td>
                        <td>{{ ucfirst($subject->description) }}</td>
                        <td>{{ strtoupper($subject->schedule) }}</td>
                        <td>{{ strtoupper($subject->time_start) }}</td>
                        <td>{{ strtoupper($subject->time_end) }}</td>
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditSubject', ['id' => $subject->id]) }}')"
                                    class="btn btn-success text-white">Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $subjects->links('vendor.pagination.materialize') }}
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