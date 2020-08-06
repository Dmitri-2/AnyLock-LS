@extends("layouts.master")
@section('body')

    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h1>Expiry List</h1>
                <p>The following lockers are expired, and the locks should be cut</p>
            </div>
        </div>
        <div class="card col-8 mx-auto">
            <div class="card-body text-center">
                <table class="table table-striped">
                    <thead>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Location</th>
                    <th scope="col">Locker Number</th>
                    <th scope="col"></th>
                    </thead>
                    <tbody>
                    @foreach($expired as $rental)
                        <tr>
                            <td>{{$rental->user->name}}</td>
                            <td>{{$rental->user->email}}</td>
                            <td>{{$rental->locker->location->name}}</td>
                            <td>{{$rental->locker->locker_num}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#lockerConfirmModal-{{$rental->locker->id}}"><i class="fas fa-store-alt-slash"></i></button>
                                <div class="modal fade" id="lockerConfirmModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Confirm Locker Rental</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <strong> User: </strong> {{$rental->user->name}}
                                                </div>
                                                <div>
                                                    <strong> Locker Number: </strong> {{$rental->locker->locker_num}}
                                                </div>

                                                <div class="my-3 mx-5 text-left">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-identity-{{$rental->locker->id}}"
                                                               id="locker-check-identity-{{$rental->locker->id}}"
                                                               onclick="userAcknowledged({{$rental->locker->id}})">
                                                        <label class="form-check-label" for="locker-check-identity-{{$rental->locker->id}}">
                                                            I have verified the user's identity
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-into-{{$rental->locker->id}}"
                                                               id="locker-check-into-{{$rental->locker->id}}"
                                                               onclick="userAcknowledged({{$rental->locker->id}})">
                                                        <label class="form-check-label" for="locker-check-into-{{$rental->locker->id}}">
                                                            I have checked that the locker is ready to be checked out.
                                                        </label>
                                                    </div>
                                                </div>

                                                <h5 class="text-danger mt-2"> Please check the two boxes to confirm the locker has been cleaned out.</h5>

                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="POST" action="{{route("checkedOut")}}">
                                                            @csrf
                                                            <input name="rental_id" value="{{$rental->id}}" hidden>
                                                            <button class="btn btn-success btn-block" id="locker-check-in-btn-{{$rental->locker->id}}" disabled>Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col">
                <h1>Expiring List</h1>
                <p>The following lockers will soon be expired</p>
            </div>
        </div>
        <div class="card col-8 mx-auto">
            <div class="card-body text-center">
                <table class="table table-striped">
                    <thead>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Location</th>
                    <th scope="col">Locker Number</th>
                    <th scope="col"></th>
                    </thead>
                    <tbody>
                    @foreach($expiring as $rental)
                        <tr>
                            <td>{{$rental->user->name}}</td>
                            <td>{{$rental->user->email}}</td>
                            <td>{{$rental->locker->location->name}}</td>
                            <td>{{$rental->locker->locker_num}}</td>
                            <td class="text-center">
                                <form action="{{route('checkedOut')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                      <i class="fas fa-store-alt-slash"></i>
                                    </button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Check Out Locker</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <span class="font-weight-bold">
                                                {{$rental->locker->location->name}}: #{{$rental->locker->locker_num}} Rented by: {{$rental->user->name}}
                                            </span>
                                            <hr>
                                            I, {{$user->name}}, have checked out and confirmed locker #{{$rental->locker->locker_num}} has been cleaned and is ready to be rented again.
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
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
