@if(Session::has('autherror'))
    <p class = "red-text font-zilla"><i class = "material-icons align-text tiny">error</i> <b>AUTH:</b> {{ Session::get('autherror') }}</p>
@endif