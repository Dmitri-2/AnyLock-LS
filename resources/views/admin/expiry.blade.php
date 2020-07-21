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
                </thead>
                <tbody>
                @foreach($expired as $locker)
                    <tr>
                        <td>{{$locker->full_name}}</td>
                        <td>{{$locker->email}}</td>
                        <td>{{$locker->location_name}}</td>
                        <td>{{$locker->locker_num}}</td>
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
                </thead>
                <tbody>
                @foreach($expiring as $locker)
                    <tr>
                        <td>{{$locker->full_name}}</td>
                        <td>{{$locker->email}}</td>
                        <td>{{$locker->location_name}}</td>
                        <td>{{$locker->locker_num}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
