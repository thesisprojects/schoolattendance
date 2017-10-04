@extends('templates.master')

@section('title', 'Roles and Permissions')

@section('content')
    @include('snippets.sidenav-pack')

    <div class="container">
        {{ Form::open(['route'=>'postCreateRole']) }}
        @component('components.modal', [
            'id' => 'create-roles-modal',
            'title' => 'Create role',
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
                    <label for="name">Role name</label>
                    <input type="text" name="name" minlength="2" maxlength="8" required>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <label for="description">Description</label>
                    <input type="text" name="description" minlength="4" maxlength="16" required>
                </div>
            </div>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col s12 m6 l4">
                        <p>
                            <input type="checkbox" class="filled-in" name="role_data_{{ $permission->name }}"
                                   id="{{ $permission->name }}_box" value="{{ $permission->id }}"/>
                            <label for="{{ $permission->name }}_box">{{ ucfirst($permission->name) }}</label>
                        </p>
                    </div>
                @endforeach
            </div>
        @endcomponent
        {{ Form::close() }}
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i data-target="create-roles-modal" class="large material-icons waves-effect modal-trigger">add</i>
            </a>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">


                    <div class="row">
                        <div class="col s12 m12 l12">
                            <label class="grey-text">Available roles</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            @component('components.table', ['tableHeaders' => ['Role', 'Action', '']])
                                @foreach($roles as $role)
                                    <tr>
                                        <td class="grey-text">
                                            <div class="row">
                                                <div class="col s12 m12">
                                                    <b>{{ ucwords($role->name) }}</b>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                @foreach($role->permissions as $permission)
                                                    <div class="col s12 m6 l4">
                                                        <label>-{{ ucfirst($permission->name) }}</label></div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="grey-text center">
                                            <div class="row">
                                                <div class="col s12 m12">
                                                    <a href="{{ route('getEditRole', ['roleID' => $role->id]) }}"
                                                       class="btn grey grey-text text-lighten-2 waves-effect">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('snippets.dialog')
    </div>
@endsection

@section('additionalJS')
@endsection