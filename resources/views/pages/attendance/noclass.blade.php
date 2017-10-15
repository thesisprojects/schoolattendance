@extends('templates.master')

@section('title', 'List of course')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        <div class="card-panel">
            <h1 class="center"><i class="material-icons large green-text">sentiment_very_satisfied</i></h1>
            <h3 class="grey-text flow-text">No class in this time, take a break, take a kitkat.</h3>
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