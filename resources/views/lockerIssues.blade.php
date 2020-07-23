@extends("layouts.master")

@section('body')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Locker Report</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Row Number</th>
                        <th scope="col">Column Number</th>
                        <th scope="col">Location</th>
                        <th scope="col">Locker Number</th>
                        <th scope="col">Locker Status</th>
                        <th scope="col">Disable / Enable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <th>1</th>
                        <td>FAB</td>
                        <td>115</td>
                        <td>Available</td>
                        <td><button id="demoButton" type="button" class="btn btn-primary"
                                onclick="changeStatus('demoButton')">Enabled</button></td>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <td>FAB</td>
                        <td>116</td>
                        <td>Broken</td>
                        <td><button id="demoButton1" type="button" class="btn btn-primary"
                                onclick="changeStatus('demoButton1')">Enabled</button></td>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>3</th>
                        <td>FAB</td>
                        <td>117</td>
                        <td>Available</td>
                        <td><button id="demoButton2" type="button" class="btn btn-primary"
                                onclick="changeStatus('demoButton2')">Enabled</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
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
</script>
@endpush
