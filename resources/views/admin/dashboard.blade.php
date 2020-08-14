
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
                    <div class="card-header text-center"><h4>Recently Updated Rentals</h4></div>
                    <div class="card-body">

                        {{-- Section below copied from the rentals.blade.php file --}}

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Id</th>
                                <th scope="col" class="text-center">User</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">End Date</th>
                                <th scope="col" class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRentals as $rental)
                                    <tr>
                                        <td class="text-center">{{$rental->locker->locker_num}}</td>
                                        <td class="text-center">{{$rental->user->name}}</td>
                                        <td class="text-center">{{$rental->status}}</td>
                                        <td class="text-center">{{$rental->end_date()}}</td>
                                        <td class="text-center">
                                            <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-cog"></i>
                                            </button>

                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Rental</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                                <strong> User: </strong> {{$rental->user->name}}
                                                            </div>
                                                            <div>
                                                                <strong> Locker Number: </strong> {{$rental->locker->locker_num}}
                                                            </div>
                                                            <div>
                                                                <strong> Location: </strong> {{$rental->locker->location->name}}
                                                            </div>
                                                            <hr>
                                                            <form action="{{route('confirmRental')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                                                <input type="submit" class="btn btn-warning btn-block font-weight-bold" value="Set Active">
                                                            </form>
                                                            <br>
                                                            <form action="{{route('checkedOut')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                                                <input type="submit" class="btn btn-warning btn-block font-weight-bold" value="Check Out">
                                                            </form>
                                                            <br>
                                                            <form action="{{route('cancelRental')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                                                <input type="submit" class="btn btn-warning btn-block font-weight-bold" value="Cancel Rental">
                                                            </form>
                                                            <hr>
                                                            <form action="{{route('updateDate')}}" method="POST" >
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="rental_end_date"><h5>Change Rental End Date</h5></label>
                                                                    <div class="input-group mb-3">
                                                                        <input class="form-control" type="date" name="end_date" id="rental_end_date" required>
                                                                        <div class="input-group-append">
                                                                            <input class="btn btn-primary" type="submit">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection
