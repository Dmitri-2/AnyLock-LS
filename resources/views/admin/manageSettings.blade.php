@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">Settings</h2>



                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Id</th>
                            <th scope="col" class="text-center">Key</th>
                            <th scope="col" class="text-center">Value</th>
                            <th scope="col" class="text-center">Last Updated</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td class="text-center">{{$setting->id}}</td>
                                <td class="text-center">{{$setting->key}}</td>
                                <td class="text-center">{{$setting->value}}</td>
                                <td class="text-center">{{$setting->updated_at}}</td>
                                <td class="text-center">
                                    <form method="GET" action="{{route("viewSetting")}}">
                                        @csrf
                                        <input name="setting_id" value="{{$setting->id}}" hidden>
                                        <button type="submit" class="btn btn-primary btn-sm"> Change </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
