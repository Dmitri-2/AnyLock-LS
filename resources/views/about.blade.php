@extends('layouts.master')

@section('body')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h1> About AnyLock</h1>
                <p>This will be a customizable page in the future!</p>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center px-2 mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0"> User Instructions </h5>
                </div>
                <div class="card-body">
                    How to do stuff
                    <ol>
                        <li> Make a account </li>
                        <li> Go to the locker rental page </li>
                        <li> Come to the front desk and a employee will take you to your locker </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0"> User Check Out Instructions </h5>
                </div>
                <div class="card-body">
                    <ol>
                        <li> Come to the front desk and a employee will go to your locker with you </li>
                        <li> Remove your lock and a employee will put out lock on the locker </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection


