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
                    @foreach($expired as $locker)
                        <tr>
                            <td>{{$locker->full_name}}</td>
                            <td>{{$locker->email}}</td>
                            <td>{{$locker->location_name}}</td>
                            <td>{{$locker->locker_num}}</td>
                            <td class="text-center">
                                <form action="{{route('checkedOut')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rental_id" value="{{$locker->id}}">
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
                                                {{$locker->location_name}}: #{{$locker->locker_num}} Rented by: {{$locker->full_name}}
                                            </span>
                                            <hr>
                                            I, {{$user->name}}, have checked out and confirmed locker #{{$locker->locker_num}} has been cleaned and is ready to be rented again.
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
                    @foreach($expiring as $locker)
                        <tr>
                            <td>{{$locker->full_name}}</td>
                            <td>{{$locker->email}}</td>
                            <td>{{$locker->location_name}}</td>
                            <td>{{$locker->locker_num}}</td>
                            <td class="text-center">
                                <form action="{{route('checkedOut')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rental_id" value="{{$locker->id}}">
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
                                                {{$locker->location_name}}: #{{$locker->locker_num}} Rented by: {{$locker->full_name}}
                                            </span>
                                            <hr>
                                            I, {{$user->name}}, have checked out and confirmed locker #{{$locker->locker_num}} has been cleaned and is ready to be rented again.
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
