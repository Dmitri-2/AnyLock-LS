@extends("layouts.master")


@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">All Rentals</h2>
                @foreach($rentals as $status => $statusrentals)
                <table class="table table-striped">
                    <thead>
                        <h2>{{ucfirst($status)}}</h2>
                    <tr>
                        <th scope="col" class="text-center">Locker Id #</th>
                        <th scope="col" class="text-center">Locker Location</th>
                        <th scope="col" class="text-center">User</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">End Date</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(empty ( $statusrentals ))
                    <tr>
                        <td colspan="6" class="text-center">
                            <h3>No Rentals</h3>
                        </td>
                    </tr>
                    @else
                    @foreach($statusrentals as $rental)
                        <tr>
                            <td class="text-center">{{$rental->locker->locker_num}}</td>
                            <td class="text-center">{{$rental->locker->location->name}}</td>
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
                    @endif
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection
