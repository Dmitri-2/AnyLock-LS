
@extends("layouts.master")

@section('body')

    <div class="container">
        <h2 class="text-center mb-3"> Admin Dashboard </h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-3 border shadow text-center">

                    <div class="card-body">
                        <h2>Locker Rentals: {{$lockerRentalCount}} </h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 border shadow text-center">
                    <div class="card-body">
                        <h2>User Count: {{$userCount}}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 border shadow text-center">
                    <div class="card-body">
                        <h2>Locker Count: {{$lockerCount}}</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
