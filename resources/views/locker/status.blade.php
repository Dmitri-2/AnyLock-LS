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
                            <td class="text-center">{{$current->locker_num}}</td>
                            <td class="text-center">{{$current->location}}</td>
                            <td class="text-center">{{$current->end_date()}}</td>
                            <td class="text-center">{{$current->status}}</td>
                                <td class="text-center">
                                    @if($current->status == 'rented')
                                    <button type="button" class="btn btn-block btn-sm btn-primary">Renew Rental</button>
                                    @endif
                                </td>
                            <td>
                                @if($current->status != 'expired')
                                <form method="POST" action="{{route("cancelUserRental")}}">
                                    @csrf
                                    <input name="rental_id" value="{{$current->id}}" hidden>
                                    <button type="submit" class="btn btn-block btn-sm btn-danger">Cancel Rental</button>
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
@endsection


