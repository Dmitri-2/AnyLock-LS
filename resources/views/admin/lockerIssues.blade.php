@extends("layouts.master")

@section('body')

<div id="locations" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Locker Report</h1>
            <select id="locationSelect" class="form-control" name="location">
                    option value="-1">Choose...</option>
                @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
            </select>

            <div id="tableDiv">
                <table class="table">
                    <thead class="thead-dark">
                         <tr>
                            <th scope="col">Locker Number</th>
                            <th scope="col">Locker Status</th>
                            <th scope="col">Disable / Enable</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($lockers as $locker)
                    <!-- You need to make this work for lockers dynamically. This is just a test to get it to work.
                         If the locker needs to be disabled or enabled, check on the backend if it already enabled
                        or disabled, because you are loading all of the info at the beggining, and multiple people may
                        be trying to disable or enable lockers. -->
                    <tr><td> {{$locker->locker_num}}</td><td>{{$locker->status}}</td><td>
                        <form method="POST">
                            {{ csrf_field() }}
                            @if($locker->status != 'broken')
                            <input id="disable" name="disable" value="disable" hidden>
                            <input id="{{$locker->id}}" name="locker_id" value="{{$locker->id}}" hidden>
                            <button type="submit" class="btn btn-danger">Disable</button>
                            @else
                            <input id="enable" name="enable" value="enable" hidden>
                            <input id="{{$locker->id}}" name="locker_id" value="{{$locker->id}}" hidden>
                            <button type="submit" class="btn btn-primary">Enable</button>
                            @endif
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<style>
    select{
        margin: 2em 0 !important;
    }
    #locations {
        text-align: center;
    }
</style>
@endpush

@push('js')
<script>

    $('.form-control').change(function(){
        $locationId = $(this).val()
        $('tr').remove();
        $('.thead-dark').append('<tr><th scope="col">Location</th><th scope="col">Locker Number</th><th scope="col">Locker Status</th><th scope="col">Disable / Enable</th></tr>');
        @foreach($lockers as $locker)
        $lockerLocId = {{$locker->location_id}};

            if($locationId == $lockerLocId)
            {
                $lockerNum = {{$locker->locker_num}};
                @if($locker->status === 'available')
                $lockerStat = 'available';
                @elseif($locker->status === 'rented')
                $lockerStat = 'rented';
                @elseif($locker->status === 'pending')
                $lockerStat = 'pending';
                @elseif($locker->status === 'broken')
                $lockerStat = 'broken';
                @elseif($locker->status === 'expiring')
                $lockerStat = 'expiring';
                @elseif($locker->status === 'expired')
                $lockerStat = 'expired';
                @else
                $lockerStat = 'NA';
                @endif

                $('#tbody').append('<tr><td>' + {{$locker->locker_num}} + '</td><td>' + $lockerStat + '</td><td><button id="' + {{$locker->id}} + '" type="button" class="btn btn-primary" onclick="changeStatus(' + {{$locker->id}} +')">Enabled</button></td></tr>');
            }
        @endforeach
    });

</script>
@endpush
