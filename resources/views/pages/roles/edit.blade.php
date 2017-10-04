@extends('templates.master')

@section('title', 'Roles and Permissions')

@section('content')
    @include('snippets.sidenav-pack')

    <div class="container" id="editroleapp">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <label id="route" hidden>{{ Route('postUpdateRole') }}</label>
                    <a class = "right hover-red" href = "{{ route('getRoles') }}"><i class = "material-icons tiny align-text">arrow_back</i> Go back</a>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <label class="grey-text">Editing {{ lcfirst($role->name) }}'s permissions.</label>
                        </div>
                        <input type = "text" name = "role" value = "{{ $role->id }}" id = "role" hidden>
                    </div>

                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col s12 m6 l4">
                                <p>
                                    <input type="checkbox" class="filled-in" name="role_data_{{ $permission->name }}" id="{{ $permission->name }}_box"
                                           value="{{ $permission->id }}" {{$role->permissions->contains('name', $permission->name) ? 'checked' : ''}} @change = "togglePermission('{{$permission->id}}')
                                    "/>
                                    <label title="{{ $permission->description }}" for="{{ $permission->name }}_box">{{ ucfirst($permission->name) }}</label>
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="row" id="loader" hidden>
                        <div class="col s12 m12 l12">
                            <label id="loading-action">Saving...</label>

                            <div class="progress">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('snippets.dialog')
    </div>
@endsection

@section('additionalJS')
    <script src="{{ URL::asset('js/editrole.js') }}"></script>
@endsection