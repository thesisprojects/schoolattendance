@extends('templates.master')

@section('title', 'List of course')

@section('content')
    @include('snippets.sidenav-pack')
    <div class="container">
        <input type="hidden" id="subject_id" value="{{ $subject->id }}"/>
        <input type="hidden" id="subject_name" value="{{ $subject->name }}"/>
        <input type="hidden" id="subject_teacher"
               value="{{ $subject->teacher->last_name }}, {{ $subject->teacher->first_name }}"/>
        @if(is_null($subject))
            <div class="card-panel">
                <h1 class="center"><i class="material-icons large green-text">sentiment_very_satisfied</i></h1>
                <h3 class="grey-text flow-text">No class in this time, take a break, take a kitkat.</h3>
            </div>
        @else
            <div class="card-panel">
                <h3 class="flow-text">{{!is_null($subject) ? "Students for " . $subject->name : "No class in this time, take a break, take a kitkat."}}</h3>
                <ul class="collection" id="subject-students">
                    @foreach($students as $student)
                        <li class="collection-item dismissable" id="{{ $student->id }}-attendance">
                            <div>{{ $student->last_name }}, {{ $student->first_name }}
                                <a href="#" class="waves-effect secondary-content red-text absentButton"
                                   data-id="{{ $student->id }}"
                                   data-contact="{{ $student->parent_contact_number }}"
                                   data-fullname="{{$student->first_name}}, {{$student->last_name}}"
                                   style="margin: 4px;">Absent</a>
                                <a href="#" class="waves-effect secondary-content amber-text lateButton"
                                   data-id="{{ $student->id }}"
                                   data-contact="{{ $student->parent_contact_number }}"
                                   data-fullname="{{$student->first_name}}, {{$student->last_name}}"
                                   style="margin: 4px;">Late</a>
                                <a href="#" class="waves-effect secondary-content green-text presentButton"
                                   data-id="{{ $student->id }}"
                                   data-contact="{{ $student->parent_contact_number }}"
                                   data-fullname="{{$student->first_name}}, {{$student->last_name}}"
                                   style="margin: 4px;">Present</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col s12 m12 l12" id="response-display">
            @include('snippets.dialog')
        </div>
    </div>
@endsection

@section('additionalJS')
    <script>
        $(document).ready(function () {
            $(".absentButton").on("click", function (event) {
                var userID = event.currentTarget.attributes['data-id'].nodeValue;
                var fullname = event.currentTarget.attributes['data-fullname'].nodeValue;
                var parentPhoneNumber = event.currentTarget.attributes['data-contact'].nodeValue;
                var subjectID = $("#subject_id").val();
                var subjectName = $("#subject_name").val();
                var subjectTeacher = $("#subject_teacher").val();
                $.post("/attendancesystem/attendance", {student_id: userID, subject_id: subjectID, type: "absent"})
                    .done(function (response) {
                        Materialize.toast(fullname + " marked as absent", 5000, "red");
                        $("#" + userID + "-attendance").remove();

                        var textMessageContent = "This is an automated message from Cor Jesu College attendance system [DO NOT REPLY IN THIS NUMBER]. Student " + fullname + " has been marked absent from subject " + subjectName + " under " + subjectTeacher + ".";
                        $.post("/attendancesystem/notify", {
                            phone_number: parentPhoneNumber,
                            content: textMessageContent,
                        })
                            .done(function (response) {
                                Materialize.toast(fullname + "'s parent has been notified in text messaging", 5000, "green");
                            }).fail(function (response) {
                            console.log(response);
                            Materialize.toast("SOMETHING WENT WRONG", 5000, "red");
                        });

                    }).fail(function (response) {
                    console.log(response);
                    Materialize.toast("SOMETHING WENT WRONG", 5000, "red");
                });
            });
            $(".lateButton").on("click", function (event) {
                var userID = event.currentTarget.attributes['data-id'].nodeValue;
                var fullname = event.currentTarget.attributes['data-fullname'].nodeValue;
                var parentPhoneNumber = event.currentTarget.attributes['data-contact'].nodeValue;
                var subjectID = $("#subject_id").val();
                var subjectName = $("#subject_name").val();
                var subjectTeacher = $("#subject_teacher").val();
                $.post("/attendancesystem/attendance", {student_id: userID, subject_id: subjectID, type: "late"})
                    .done(function (response) {
                        Materialize.toast(fullname + " marked as late", 5000, "amber");
                        $("#" + userID + "-attendance").remove();


                        var textMessageContent = "This is an automated message from Cor Jesu College attendance system [DO NOT REPLY IN THIS NUMBER]. Student " + fullname + " has been marked absent from subject " + subjectName + " under " + subjectTeacher + ".";
                        console.log(textMessageContent);
                        $.post("/attendancesystem/notify", {
                            phone_number: parentPhoneNumber,
                            content: textMessageContent,
                        })
                            .done(function (response) {
                                Materialize.toast(fullname + "'s parent has been notified in text messaging", 5000, "green");
                            }).fail(function (response) {
                            console.log(response);
                            Materialize.toast("SOMETHING WENT WRONG", 5000, "red");
                        });

                    }).fail(function (response) {
                    console.log(response);
                    Materialize.toast("SOMETHING WENT WRONG", 5000, "red");
                });
            });
            $(".presentButton").on("click", function (event) {
                var userID = event.currentTarget.attributes['data-id'].nodeValue;
                var fullname = event.currentTarget.attributes['data-fullname'].nodeValue;
                var subjectID = $("#subject_id").val();
                $.post("/attendancesystem/attendance", {student_id: userID, subject_id: subjectID, type: "present"})
                    .done(function (response) {
                        Materialize.toast(fullname + " marked as present", 5000, "green");
                        $("#" + userID + "-attendance").remove();
                    }).fail(function (response) {
                    console.log(response);
                    Materialize.toast("SOMETHING WENT WRONG", 5000, "red");
                });
            });
        });
    </script>
@endsection