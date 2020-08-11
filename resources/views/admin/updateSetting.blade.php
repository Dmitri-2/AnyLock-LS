@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">Update Setting</h2>

                <form method="POST" action="{{route("updateSetting")}}">
                    @csrf
                    <div class="d-flex">
                        <h5>Setting Name:</h5> <span class="ml-3"> {{$setting->key}} </span>
                    </div>
                    <div class="form-group">
                        <h5><label for="setting_value">Current Value: </label></h5>
                        <textarea class="form-control" id="setting_value" name="setting_value" rows="7">{{$setting->value}}</textarea>
                    </div>
                    <input name="setting_id" value="{{$setting->id}}" hidden>
                    <button class="btn btn-primary"> Save Changes </button>
                </form>

            </div>
        </div>
    </div>
@endsection
