@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class = "red-text font-zilla"><i class = "material-icons align-text tiny">error</i><b>VALIDATION:</b> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
