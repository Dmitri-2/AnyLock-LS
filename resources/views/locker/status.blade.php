@extends('layouts.master')

@section('body')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h1> Locker Status</h1>
                <p>An overview of all your lockers</p>
            </div>
        </div>
        <div class="card col-8 mx-auto">
            <div class="card-body text-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Locker Number</th>
                        <th scope="col">Location</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rentals as $current)
                    <tr>
                        <td>{{$current->locker_num}}</td>
                        <td>{{$current->location}}</td>
                        <td>{{$current->end_date}}</td>
                        <td>{{$current->status}}</td>
                    @if($current->status == 'rented' || $current->status == 'expiring')
                        <td><button class="btn btn-success d-block" data-toggle="modal" data-target="#renewLockerForm-{{$current->locker_id}}"> <i class="fas fa-plus-square"></i>Renew</button>
                    @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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


