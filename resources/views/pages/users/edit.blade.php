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
                    {{ Form::open(['route'=>'postEditUser']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="form-group">
                                <label for="name-input">First name</label>
                                <input type="text" class="form-control" value="{{ ucwords($user->first_name) }}" id="firstname-input" name="first_name" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="form-group">
                                <label for="lastname-input">Last name</label>
                                <input type="text" class="form-control" value="{{ ucwords($user->last_name) }}" id="lastname-input" name="last_name" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="form-group">
                                <label for="username-input">Username</label>
                                <input type="text" class="form-control" id="username-input" value="{{ $user->username }}" name="username" minlength="2" maxlength="10" required>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="form-group">
                                <label for="email-input">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" id="email-input" name="email" minlength="2" maxlength="40" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="form-group">
                                <label for="password-input">Password</label>
                                <input type="password" class="form-control" id="password-input" name="password">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="form-group">
                                <label for="role-input">Role</label>
                                <select name="role" id="role-input" class="custom-select form-control">
                                    @if($user->roles->count() > 0)
                                        <option value="{{ $user->roles->first()->id }}" selected>{{ $user->roles->first()->name }}</option>
                                    @endif
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ ucwords($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
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