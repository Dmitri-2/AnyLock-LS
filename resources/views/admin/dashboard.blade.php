
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
                        <h2>User Count: {{count($users)}}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 border shadow text-center">
                    <div class="card-body">
                        <h2>Locker Count: {{count($lockers)}}</h2>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-header text-center"><h4>Create Rental Manually</h4></div>
                    <div class="card-body">
                        <form method="POST" action="{{route("adminMakeRental")}}">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    @foreach($users as $user)
                                        <option id="{{$user->id}}" value="{{$user->id}}"> {{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id">Available Lockers</label>
                                <select class="form-control" id="locker_id" name="locker_id" required>
                                    @foreach($lockers as $locker)
                                        <option id="{{$locker->id}}" value="{{$locker->id}}"> {{$locker->locker_num}} ({{$locker->location->name}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rental_end_date">Rental End Date </label>
                                <input class="form-control" type="date" name="rental_end_date" id="rental_end_date" required>
                            </div>
                            <div class="form-group my-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="approve_immediately" id="approve_immediately">
                                    <label class="form-check-label" for="approve_immediately"> Confirm rental immediately </label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 mx-auto">
                                    <button type="submit" class="btn btn-success btn-block">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border shadow ">
                    <div class="card-header text-center"><h4>Something cool here...</h4></div>
                    <div class="card-body">

                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection
