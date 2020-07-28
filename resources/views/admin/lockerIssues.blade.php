@extends("layouts.master")

@section('body')

<div id="locations" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Locker Report</h1>
            <select id="locationSelect" class="form-control" name="location">
                    <option value="-1">Choose...</option>
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
                            <th scope="col">Set Broken / Fixed</th>
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

    $('.form-control').change(function(){
        $locationId = $(this).val();
        $('tr').remove();
        $('.thead-dark').append('<tr><th scope="col">Locker Number</th><th scope="col">Locker Status</th><th scope="col">Set Broken / Fixed</th></tr>');
        @foreach($lockers->sortBy('locker_num') as $locker)
        $lockerLocId = {{$locker->location_id}};

            if($locationId == $lockerLocId)
            {
                $lockerNum = {{$locker->locker_num}};
                @if($locker->status === 'available')
                $lockerStat = 'Available';
                @elseif($locker->status === 'rented')
                $lockerStat = 'Rented';
                @elseif($locker->status === 'pending')
                $lockerStat = 'Pending';
                @elseif($locker->status === 'broken')
                $lockerStat = 'Broken';
                @elseif($locker->status === 'expiring')
                $lockerStat = 'Expiring';
                @elseif($locker->status === 'expired')
                $lockerStat = 'Expired';
                @else
                $lockerStat = 'NA';
                @endif

                $('#tbody').append('<tr><td>' + {{$locker->locker_num}} + '</td><td>' + $lockerStat + '</td><td> <form method="POST" action="{{ route('updateBrokenStatus') }}">' +
                            '{{ csrf_field() }} @if($locker->status != "broken")' +
                            '<input id="broken" name="broken" value="broken" hidden>' +
                            '<input id="{{$locker->id}}" name="locker_id" value="{{$locker->id}}" hidden>' +
                            '<button type="submit" class="btn btn-danger">Broken</button> @else' +
                            '<input id="fixed" name="fixed" value="fixed" hidden>' +
                            '<input id="{{$locker->id}}" name="locker_id" value="{{$locker->id}}" hidden>' +
                            '<button type="submit" class="btn btn-primary">Fixed</button> @endif' +
                        '</form>');
            }
        @endforeach
    });

</script>
@endpush
