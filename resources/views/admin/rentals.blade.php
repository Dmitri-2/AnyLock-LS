@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">All Rentals</h2>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Locker Id #</th>
                        <th scope="col" class="text-center">Locker Location</th>
                        <th scope="col" class="text-center">User</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rentals as $rental)
                        <tr>
                            <td class="text-center">{{$rental->locker->locker_num}}</td>
                            <td class="text-center">{{$rental->locker->location->name}}</td>
                            <td class="text-center">{{$rental->user->name}}</td>
                            <td class="text-center">{{$rental->status}}</td>
                            <td class="text-center">{{$rental->end_date()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
