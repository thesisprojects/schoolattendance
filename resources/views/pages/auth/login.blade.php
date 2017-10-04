@extends('templates.master')

@section('title', 'Login')

@section('content')
    <div id="loginapp">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <center>
                        <br><br>
                        <p class="grey-text text-darken-2 center">Ametur Cor Jesu.</p>
                        <div class="card login-card animated bounceIn">

                            <div class="card-image">
                                <img src="{{ URL::asset('images/banner.png') }}">
                            </div>
                            <div class="card-content">

                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        {{ Form::open(['route' => 'postLogin']) }}
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col s12 m12 l12 input-field">
                                                @include('snippets.validationerrors')
                                                @include('snippets.autherror')
                                                @include('snippets.exceptionerror')
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 input-field">
                                                <label class="left" for="email">Email:</label>
                                                <input type="email" name="email" id="email" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 input-field">
                                                <label class="left" for="password">Password:</label>
                                                <input type="password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m12 l12 center">
                                                <button class="btn white-text green waves-effect">Login</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additionalJS')
    <script src="{{ URL::asset('js/login.js') }}"></script>
@endsection