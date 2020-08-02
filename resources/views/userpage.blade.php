
@extends('layouts.master')

@section('body')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class=" card-header text-center">
                        Personal Information
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route("updateUserInfo")}}">
                            {{csrf_field()}}
                            <div class="col-md-12 text-center">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label ml-md-4"> Name </label>
                                    <div class="col-md-7 mt-1">
                                        <input id="name" class="w-100" name="name" type="text" value="{{$user->name}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label ml-md-4">  Email </label>
                                    <div class="col-md-7 mt-2 text-left ">
                                        <input id="email" class="w-100" name="email" type="email" value="{{$user->email}}" >
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <button class="btn btn-primary d-block mx-auto" type="submit"> <i class="fas fa-sync-alt"></i> Save </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center mt-3 mt-md-0">
                <div class="card">
                    <div class=" card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route("updateUserPassword")}}">
                            {{csrf_field()}}
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="oldpass" class="col-md-6 col-form-label"> Old Password </label>
                                    <div class="col-md-4 mt-1">
                                        <input id="oldpass" name="oldpass" type="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newpass" class="col-md-6 col-form-label"> New Password </label>
                                    <div class="col-md-4 mt-1">
                                        <input id="newpass" name="newpass" type="password">
                                    </div>
                                </div>
                                <hr class="my-4">
                            </div>
                            <button class="btn btn-primary d-block mx-auto" type="submit"> <i class="fas fa-key"></i> Change </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

