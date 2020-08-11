@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">All Locations</h2>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Id</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Rows</th>
                        <th scope="col" class="text-center">Height</th>
                        <th scope="col" class="text-center">Depth</th>
                        <th scope="col" class="text-center">Dept</th>
                        <th scope="col" class="text-center">Layout</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td class="text-center">{{$location->id}}</td>
                            <td class="text-center">{{$location->name}}</td>
                            <td class="text-center">{{$location->numrows}}</td>
                            <td class="text-center">{{$location->height}}</td>
                            <td class="text-center">{{$location->depth}}</td>
                            <td class="text-center">{{$location->dept}}</td>
                            <td class="text-center">{{$location->layout}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
