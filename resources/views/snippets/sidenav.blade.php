<ul id="slide-out" class="side-nav fixed">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{ URL::asset('images/banner.png') }}">
            </div>
            <a href=""><img class="circle" src="https://api.adorable.io/avatars/285/abott@adorable.pngCop"></a>
            <a href=""><span class="white-text name">{{ ucwords(Auth::user()->first_name) }}</span></a>
            <a href=""><span class="white-text email">{{ ucwords(Auth::user()->email) }}</span></a>
        </div>
    </li>
    @if(Auth::user()->hasPermission('view dashboard'))
        <li>
            <a href="{{ Route('getDashboard') }}"><i class="material-icons">dashboard</i>Dashboard</a>
        </li>
    @endif
    @if(Auth::user()->hasPermission('view roles'))
            <li>
                <a href="{{ Route('getRoles') }}"><i class="material-icons">group</i>Roles and Permission</a>
            </li>
    @endif
    @if(Auth::user()->hasPermission('view users'))
        <li>
            <a href="{{ Route('getUsers') }}"><i class="material-icons">group</i>Users</a>
        </li>
    @endif

    @if(Auth::user()->hasPermission('view students'))
        <li>
            <a href="{{ Route('getStudents') }}"><i class="material-icons">group</i>Students</a>
        </li>
    @endif

    @if(Auth::user()->hasPermission('view courses'))
        <li>
            <a href="{{ Route('getCourses') }}"><i class="material-icons">book</i>Courses</a>
        </li>
    @endif
    @if(Auth::user()->hasPermission('View absent list'))
        <li>
            <a href="{{ Route('getAbsents', ['from' => \Carbon\Carbon::now(), 'to' => \Carbon\Carbon::now()]) }}"><i class="material-icons">list</i>Absents</a>
        </li>
    @endif
    @if(Auth::user()->hasPermission('View absent list'))
        <li>
            <a href="{{ Route('getDownloadDropReport') }}"><i class="material-icons">list</i>Download dropped students</a>
        </li>
    @endif
    @if(Auth::user()->hasPermission('view subjects'))
        <li>
            <a href="{{ Route('getSubjects') }}"><i class="material-icons">book</i>Subjects</a>
        </li>
    @endif
    @if(Auth::user()->hasPermission('use attendance'))
        <li>
            <a href="{{ Route('getAttendanceSystem') }}"><i class="material-icons">playlist_add_check</i>Attendance System</a>
        </li>
    @endif
    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Account settings</a></li>
    <li><a class="waves-effect" href="{{ Route('getLogout') }}" id="ui-test-logout-button"><i class="material-icons">exit_to_app</i> Logout</a></li>
</ul>
