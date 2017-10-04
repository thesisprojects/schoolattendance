@extends('templates.master')

@section('title', 'List of users')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        {{ Form::open(['route'=>'postCreateUser']) }}
        @component('components.modal', [
            'id' => 'create-users-modal',
            'title' => 'Create a user.',
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
                    <label for="username-input">Username</label>
                    <input type="text" class="form-control" id="username-input" name="username" minlength="2"
                           maxlength="10" required>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <label for="email-input">Email</label>
                    <input type="email" class="form-control" id="email-input" name="email" minlength="2" maxlength="40"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <label for="password-input">Password</label>
                    <input type="password" class="form-control" id="password-input" name="password" required>
                </div>
                <div class="col s12 m6 l6">
                    <label>Role</label>
                    <select name="role" class="browser-default">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ ucwords($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <label for="description-input">Is this account teacher?</label>
                    <select name="isTeacher" class="browser-default">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
        @endcomponent
        {{ Form::close() }}
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i data-target="create-users-modal" class="large material-icons waves-effect modal-trigger">add</i>
            </a>
        </div>
        <div class="card-panel">
            <h4 class="grey-text">List of users</h4>
            <table class="table responsive-table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ ucwords($user->first_name) }}</td>
                        <td>{{ ucwords($user->last_name) }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ ucfirst($user->email) }}</td>
                        <td>{{ ucwords($user->roles->count() > 0 ? $user->roles->first()->name : 'NO ROLE') }}</td>
                        <td>
                            <button onclick="window.location.assign('{{ route('getEditUser', ['id' => $user->id]) }}')"
                                    class="btn btn-success text-white">Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->links('vendor.pagination.materialize') }}
        </div>
    </div>
@endsection

@section('additionalJS')
@endsection