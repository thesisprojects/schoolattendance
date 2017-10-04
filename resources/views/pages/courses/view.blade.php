@extends('templates.master')

@section('title', 'List of course')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        {{ Form::open(['route'=>'postCreateCourse']) }}
        @component('components.modal', [
            'id' => 'create-course-modal',
            'title' => 'Create a course.',
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
                    <label for="name-input">Name</label>
                    <input type="text" class="form-control" id="name-input" name="name" minlength="2"
                           maxlength="45" required>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <label for="slug-input">Slug</label>
                    <input type="text" class="form-control" id="slug-input" name="slug" minlength="2"
                           maxlength="45" required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12 input-field">
                    <label for="description-input">Description</label>
                    <input type="text" class="form-control" id="description-input" name="description" minlength="2"
                           maxlength="45" required>
                </div>
            </div>
        @endcomponent
        {{ Form::close() }}
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i data-target="create-course-modal" class="large material-icons waves-effect modal-trigger">add</i>
            </a>
        </div>
        <div class="card-panel">
            <h4 class="grey-text">List of courses</h4>
            <table class="table responsive-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ ucfirst($course->name) }}</td>
                        <td>{{ strtolower($course->slug) }}</td>
                        <td>{{ ucfirst($course->description) }}</td>
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditCourse', ['id' => $course->id]) }}')"
                                    class="btn btn-success text-white">Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $courses->links('vendor.pagination.materialize') }}
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