@extends("layouts.master")

@section('body')

<div id="locations" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Locker Report</h1>
            <form type="POST">
                <div class="form-group">
                <select id="locationSelect" class="form-control" name="location">
                    <option value="-1">Choose...</option>
                    @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                </select>
            </form>
            <div id="tableDiv">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Location</th>
                            <th scope="col">Locker Number</th>
                            <th scope="col">Locker Status</th>
                            <th scope="col">Disable / Enable</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

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
function changeStatus(id) {
    locker = document.getElementById(id);
    if (locker.innerHTML == "Enabled") {
        locker.innerHTML = "Disabled";
    } else {
        locker.innerHTML = "Enabled";
    }
}

$()

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

            $('#tbody').append('<tr><td>FAB</td> <td>' + {{$locker->locker_num}} + '</td><td>' + $lockerStat + '</td><td><button id="' + {{$locker->id}} + '" type="button" class="btn btn-primary" onclick="changeStatus(' + {{$locker->id}} +')">Enabled</button></td></tr>');
        }
    @endforeach
});

</script>
@endpush
