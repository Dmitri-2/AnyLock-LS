@if (session('alert'))
    <div class="w-75 mx-auto">
        <div class="alert alert-{{ session('alert') }}">
            @if (session('alertMessage'))
                {!! session('alertMessage') !!}
            @endif
        </div>
    </div>
@endif