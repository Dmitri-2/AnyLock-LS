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
                    @if($current->status == 'rented')
                        <form method="POST" action="{{ route('renewLocker') }}">
                        {{ csrf_field() }}
                            <input id="renewal" name="renewal" value="renewal" hidden>
                            <input id="{{$current->locker_id}}" name="locker_id" value="{{$current->locker_id}}" hidden>
                            <td><button type="submit" class="btn btn-primary">Renew</button>
                        </form>
                    @endif
                    </tr>
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection


