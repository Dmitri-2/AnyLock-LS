@extends('layouts.master')

@section('body')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h1> About AnyLock</h1>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center px-5 mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0"> About the AnyLock Locker System </h5>
                </div>
                <div class="card-body">
                    The AnyLock Locker System is a open source locker rental system, written in the Laravel framework.
                    The project is MIT Licensed and can be used commercially or for personal use. The GitHub repository for this project
                    is <a href="https://github.com/Dmitri-2/AnyLock-LS"> here. </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center px-5 mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0"> User Instructions </h5>
                </div>
                <div class="card-body">
                    If you are looking to rent a locker, you've come to the right place. You should follow the steps below to get started:
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
                    <h5 class="mb-0"> Check-In Instructions </h5>
                </div>
                <div class="card-body">
                    <ol>
                        <li> Come to the front desk and a employee will go to the locker you have chosen with you </li>
                        <li> The employee will remove our lock and you will be able to put your lock on your locker </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="mb-0"> Check Out Instructions </h5>
                </div>
                <div class="card-body">
                    <ol>
                        <li> Come to the front desk and a employee will go to your locker with you </li>
                        <li> You should remove all of your belonings from the locker  </li>
                        <li> Remove your lock and a employee will put out lock on the locker </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection


