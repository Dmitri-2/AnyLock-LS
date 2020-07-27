@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">Pending Rentals</h2>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">User</th>
                        <th class="text-center">Locker Id #</th>
                        <th class="text-center">Locker Location</th>
                        <th class="text-center">Requested End Date</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pendingRentals as $rental)
                        <tr>
                            <td class="text-center">{{$rental->user->name}}</td>
                            <td class="text-center">{{$rental->locker->locker_num}}</td>
                            <td class="text-center">{{$rental->locker->location->name}}</td>
                            <td class="text-center">{{$rental->end_date()}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lockerConfirmModal-{{$rental->locker->id}}">Confirm Rental</button>
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

                                                <div class="my-3">
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
                                                            I have checked the user into their locker
                                                        </label>
                                                    </div>
                                                </div>

                                                <h5 class="text-danger mt-2"> Please check the two boxes to confirm the rental.</h5>

                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="POST" action="{{route("confirmRental")}}">
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
                            <td>
                                <form method="POST" action="{{route("cancelRental")}}">
                                    @csrf
                                    <input name="rental_id" value="{{$rental->id}}" hidden>
                                    <button type="submit" class="btn btn-danger">Cancel Rental</button>
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

@push("js")
    <script>
        function userAcknowledged(lockerId) {
            let identity = $("#locker-check-identity-"+lockerId).prop("checked");
            let checkedIn = $("#locker-check-into-"+lockerId).prop("checked");

            console.log(" button check : "+lockerId);

            console.log(" button selector: "+".locker-check-in-btn-"+lockerId);
            if(identity && checkedIn){
                console.log("enabling button: "+"locker-check-in-btn-"+lockerId);
                $("#locker-check-in-btn-"+lockerId).prop('disabled', false);
            } else {
                $("#locker-check-in-btn-"+lockerId).prop('disabled', true);
            }
        }
    </script>

@endpush
