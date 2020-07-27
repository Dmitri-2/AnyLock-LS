
@extends("layouts.master")

@section('body')

    <div class="container">
        <h2> Admin Dashboard </h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Total Locker Rentals </div>

                    <div class="card-body">
                        <h2>There are {{$lockerRentalCount}} locker rentals...</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Total Users </div>

                    <div class="card-body">
                        <h2>There are {{$userCount}} users registered...</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
