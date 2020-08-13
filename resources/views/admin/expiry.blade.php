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
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#lockerModal-{{$rental->locker->id}}"><i class="fas fa-store-alt-slash"></i></button>

                                <div class="modal fade" id="lockerModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Locker Clean Out</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button type="button" data-dismiss="modal" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#lockerCutModal-{{$rental->locker->id}}">Cut the Lock <i class="fas fa-cut"></i></button>
                                                <button type="button" data-dismiss="modal" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#lockerConfirmModal-{{$rental->locker->id}}">Check Out Locker <i class="fas fa-file-signature"></i></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="lockerConfirmModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Confirm Locker Check Out</h4>
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

                                                <div class="my-3 mx-5 text-left">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-identity-{{$rental->locker->id}}-checkout"
                                                               id="locker-check-identity-{{$rental->locker->id}}-checkout"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'checkout')">
                                                        <label class="form-check-label" for="locker-check-identity-{{$rental->locker->id}}-checkout">
                                                            I have verified the user's identity
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-into-{{$rental->locker->id}}-checkout"
                                                               id="locker-check-into-{{$rental->locker->id}}-checkout"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'checkout')">
                                                        <label class="form-check-label" for="locker-check-into-{{$rental->locker->id}}-checkout">
                                                            I have checked that the locker is ready to be checked out.
                                                        </label>
                                                    </div>
                                                </div>

                                                <h5 class="text-danger mt-2"> Please check the two boxes to confirm the locker has been cleaned out.</h5>

                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#lockerModal-{{$rental->locker->id}}">Back</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="POST" action="{{route("checkedOut")}}">
                                                            @csrf
                                                            <input name="rental_id" value="{{$rental->id}}" hidden>
                                                            <button class="btn btn-success btn-block" id="locker-check-in-btn-{{$rental->locker->id}}-checkout" disabled>Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="lockerCutModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Confirm Cut Lock</h4>
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

                                                <div class="my-3 mx-5 text-left">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-identity-{{$rental->locker->id}}-cut"
                                                               id="locker-check-identity-{{$rental->locker->id}}-cut"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'cut')">
                                                        <label class="form-check-label" for="locker-check-identity-{{$rental->locker->id}}-cut">
                                                            We have attempted to contact the user.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-into--{{$rental->locker->id}}-cut"
                                                               id="locker-check-into-{{$rental->locker->id}}-cut"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'cut')">
                                                        <label class="form-check-label" for="locker-check-into-{{$rental->locker->id}}-cut">
                                                            I have checked that the locker is ready to be checked out.
                                                        </label>
                                                    </div>
                                                </div>

                                                <h5 class="text-danger mt-2"> Please check the two boxes to confirm.</h5>

                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#lockerModal-{{$rental->locker->id}}">Back</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="POST" action="{{route("cutLock")}}">
                                                            @csrf
                                                            <input name="rental_id" value="{{$rental->id}}" hidden>
                                                            <button class="btn btn-warning btn-block" id="locker-check-in-btn-{{$rental->locker->id}}-cut" disabled>Cut the Lock <i class="fas fa-cut"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
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
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#lockerModal-{{$rental->locker->id}}"><i class="fas fa-store-alt-slash"></i></button>

                                <div class="modal fade" id="lockerModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Locker Clean Out</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button type="button" data-dismiss="modal" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#lockerCutModal-{{$rental->locker->id}}">Cut the Lock <i class="fas fa-cut"></i></button>
                                                <button type="button" data-dismiss="modal" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#lockerConfirmModal-{{$rental->locker->id}}">Check Out Locker <i class="fas fa-file-signature"></i></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="lockerConfirmModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Confirm Locker Check Out</h4>
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

                                                <div class="my-3 mx-5 text-left">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-identity-{{$rental->locker->id}}-checkout"
                                                               id="locker-check-identity-{{$rental->locker->id}}-checkout"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'checkout')">
                                                        <label class="form-check-label" for="locker-check-identity-{{$rental->locker->id}}-checkout">
                                                            I have verified the user's identity
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-into-{{$rental->locker->id}}-checkout"
                                                               id="locker-check-into-{{$rental->locker->id}}-checkout"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'checkout')">
                                                        <label class="form-check-label" for="locker-check-into-{{$rental->locker->id}}-checkout">
                                                            I have checked that the locker is ready to be checked out.
                                                        </label>
                                                    </div>
                                                </div>

                                                <h5 class="text-danger mt-2"> Please check the two boxes to confirm the locker has been cleaned out.</h5>

                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#lockerModal-{{$rental->locker->id}}">Back</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="POST" action="{{route("checkedOut")}}">
                                                            @csrf
                                                            <input name="rental_id" value="{{$rental->id}}" hidden>
                                                            <button class="btn btn-success btn-block" id="locker-check-in-btn-{{$rental->locker->id}}-checkout" disabled>Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="lockerCutModal-{{$rental->locker->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="mx-auto">Confirm Cut Lock</h4>
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

                                                <div class="my-3 mx-5 text-left">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-identity-{{$rental->locker->id}}-cut"
                                                               id="locker-check-identity-{{$rental->locker->id}}-cut"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'cut')">
                                                        <label class="form-check-label" for="locker-check-identity-{{$rental->locker->id}}-cut">
                                                            We have attempted to contact the user.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="locker-check-into--{{$rental->locker->id}}-cut"
                                                               id="locker-check-into-{{$rental->locker->id}}-cut"
                                                               onclick="userAcknowledged({{$rental->locker->id}}, 'cut')">
                                                        <label class="form-check-label" for="locker-check-into-{{$rental->locker->id}}-cut">
                                                            I have checked that the locker is ready to be checked out.
                                                        </label>
                                                    </div>
                                                </div>

                                                <h5 class="text-danger mt-2"> Please check the two boxes to confirm.</h5>

                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#lockerModal-{{$rental->locker->id}}">Back</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="POST" action="{{route("cutLock")}}">
                                                            @csrf
                                                            <input name="rental_id" value="{{$rental->id}}" hidden>
                                                            <button class="btn btn-warning btn-block" id="locker-check-in-btn-{{$rental->locker->id}}-cut" disabled>Cut the Lock <i class="fas fa-cut"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
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

@endsection

@push("js")
    <script>
        function userAcknowledged(lockerId, type) {
            let identity = $("#locker-check-identity-"+lockerId+"-"+type).prop("checked");
            let checkedIn = $("#locker-check-into-"+lockerId+"-"+type).prop("checked");

            if(identity && checkedIn){
                $("#locker-check-in-btn-"+lockerId+"-"+type).prop('disabled', false);
            } else {
                $("#locker-check-in-btn-"+lockerId+"-"+type).prop('disabled', true);
            }
        }
    </script>

@endpush
