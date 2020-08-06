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
                        <th scope="col" class="text-center"></th>
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
                            <td class="text-center">
                                <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                  <i class="fas fa-cog"></i>
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Locker</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <span class="font-weight-bold">
                                            {{$rental->locker->location->name}}: #{{$rental->locker->locker_num}} Rented by: {{$rental->user->name}}
                                        </span>
                                        <hr>
                                        <form action="{{route('checkedOut')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                            <input type="submit" class="btn btn-primary" value="Check Out">
                                        </form>
                                        <form action="{{route('cancelRental')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="rental_id" value="{{$rental->id}}">
                                            <input type="submit" class="btn btn-primary" value="Cancel">
                                        </form>
                                        <form action="{{route('updateDate')}}" method="POST" onchange="this.submit()">
                                            @csrf
                                            <div class="form-group">
                                                <label for="rental_end_date">Rental End Date </label>
                                                <input class="form-control" type="date" name="end_date" id="rental_end_date" required>
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
@endsection
