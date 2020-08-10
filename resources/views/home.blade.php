
@extends("layouts.master")

@section('body')

    <div class="container">
        <div class="jumbotron bg-white text-center pb-3">
            <h3 class="display-3">{{$title}}</h3>
            <h5 class="text-muted">{{$subtitle}}</h5>
            <div class="mt-5">
                <small><a href="https://unsplash.com/photos/VLaKsTkmVhk">Background photo by moren hsu via Unsplash </a> </small>
                <small class="ml-4"> <i class="fas fa-balance-scale-left"></i> MIT Licensed</small>
                <small class="ml-4"><a href="https://github.com/Dmitri-2/AnyLock-LS">GitHub Repository </a> </small>
            </div>
        </div>
    </div>



@endsection


@push('css')
    <style>
        body{
            background: url("img/moren-hsu-unsplash-locker-picture.jpg");
            background-size: cover;
        }
    </style>
@endpush
