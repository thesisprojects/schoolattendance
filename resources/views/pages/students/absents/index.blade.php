@extends('templates.master')

@section('title', 'List of students')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container" id="app">
        <div class="card-panel">
            {{ Form::open(['route' => 'postLoadAbsentData']) }}
            <div class="row">
                <div class="col s12 m4 l4">
                    <label>From</label>
                    <input type="date" name="from" value="{{ $dateRange[0]->format('m/d/y') }}" required>
                </div>
                <div class="col s12 m4 l4">
                    <label>To</label>
                    <input type="date" name="to" value="{{ $dateRange[1]->format('m/d/Y') }}" required>
                </div>
                <div class="col s12 m4 l4">
                    <br>
                    <button type = "submit" class="btn btn-flat green white-text">Load
                        list</button>
                </div>
            </div>
            {{ Form::close() }}

            <p class="grey-text">Absent List of date between {{ $dateRange[0]->toDateString() }}
                and {{ $dateRange[1]->toDateString() }}</p>
            <table class="table responsive-table">
                <thead>
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>CC#</th>
                    <th>Schedule</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($absents as $absent)
                    <tr>
                        <td>{{ ucfirst($absent->student->first_name) }} {{ ucfirst($absent->student->last_name) }}</td>
                        <td>{{ ucfirst($absent->subject->name) }}</td>
                        <td>{{ ucfirst($absent->subject->cc_number) }}</td>
                        <td>
                            @foreach(\App\Classes\DateHelper::getDay($absent->subject->schedule) as $date)
                                {{ $date }},
                            @endforeach
                        </td>
                        <td>{{ $absent->getReadableAbsentDate() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

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