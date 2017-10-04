<div id="{{ $id }}" class="modal {{ $additionalClass or NULL }}">
    <div class="modal-content">
        <div class = "row header-line">
            <div class = "col s12 m12 l12">
                <h4 class = "font-zilla grey-text">{{ $title or 'UNTITLED' }}</h4>
            </div>
        </div>
        <div class = "row">
            <div class = "col s12 m12 l12">
                {{ $slot }}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        @foreach($buttons as $button)
            <button type ="{{ $button['type'] or NULL }}" class="modal-action {{ $button['class'] or NULL }} waves-effect">{{ $button['title'] }}</button>
        @endforeach
    </div>
</div>