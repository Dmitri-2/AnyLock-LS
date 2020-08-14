@extends('layouts.master')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <h2 class="my-3 text-center"> Locker Status</h2>
                <p class="text-center">An overview of all your lockers</p>
                <div class="table-responsive-lg>">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Locker #</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">End Date</th>
                        <th class="text-center">Status</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rentals as $current)
                    <tr>
                        <td>{{$current->locker_num}}</td>
                        <td>{{$current->location}}</td>
                        <td>{{$current->end_date}}</td>
                        <td>{{$current->status}}</td>
                        <td>
                            @if($current->status == 'rented' || $current->status == 'expiring')
                                <button class="btn btn-block btn-sm btn-success" data-toggle="modal" data-target="#renewLockerForm-{{$current->locker_id}}"> Renew</button>
                            @endif
                        </td>
                        <td>
                            @if($current->status != 'expired')
                            <form method="POST" action="{{route("cancelUserRental")}}">
                                @csrf
                                <input name="rental_id" value="{{$current->locker->id}}" hidden>
                                <button type="submit" class="btn btn-block btn-sm btn-danger">Cancel</button>
                            </form>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($rentals as $current)
    @if($current->status == 'rented' || $current->status == 'expiring')
    <div class="modal fade" id="renewLockerForm-{{$current->locker_id}}" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mx-auto">Choose a Date to Renew Until</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('renewLocker')}}">
                        @csrf
                        <input id="{{$current->locker_id}}" name="locker_id" value="{{$current->locker_id}}" hidden>
                        <div class="form-group">
                            <label for="rental_end_date">Rental End Date </label>
                            <input class="form-control" type="date" name="rental_end_date" id="rental_end_date" required>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block">Renew</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endsection


