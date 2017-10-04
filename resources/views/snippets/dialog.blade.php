@if(session()->has('status'))
    <label id="session-status" style="display: none;">{{ session()->get('status') }}</label>
    <script>
        Materialize.toast($('#session-status').text(), 3000);
    </script>
@endif

@if($errors->any())
    @foreach ($errors->all() as $error)
        <label id="session-error-status" style="display: none;">{{ $error }}</label>
        <script>
            Materialize.toast($('#session-error-status').text(), 3000, 'red');
            $('#session-error-status').remove();
        </script>
    @endforeach
@endif