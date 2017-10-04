@if(Session::has('exception'))
    <p class = "red-text font-zilla"><i class = "material-icons align-tex tiny">error</i> <b>FATAL:</b> {{ Session::get('exception') }}</p>
@endif