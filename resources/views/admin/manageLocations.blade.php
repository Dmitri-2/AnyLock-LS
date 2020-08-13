@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row my-3 d-flex justify-content-lg-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lockerConfirmModal">Add New Location</button>
                </div>
                <h2 class="my-3 text-center">All Locations</h2>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Rows</th>
                        <th class="text-center">Height</th>
                        <th class="text-center">Depth</th>
                        <th class="text-center">Dept</th>
                        <th class="text-center">Layout</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td class="text-center">{{$location->id}}</td>
                            <td class="text-center">{{$location->name}}</td>
                            <td class="text-center">{{$location->numrows}}</td>
                            <td class="text-center">{{$location->height}}</td>
                            <td class="text-center">{{$location->depth}}</td>
                            <td class="text-center">{{$location->dept}}</td>
                            <td class="text-center">{{$location->layout}}</td>
                            <td class="text-center">
                                <form method="POST" action="{{route("deleteLocation")}}">
                                    @csrf
                                    <input name="location_id" value="{{$location->id}}" hidden>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="modal fade" id="lockerConfirmModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{route("createLocation")}}">
                    @csrf
                    <div class="modal-header">
                    <h4 class="mx-auto">New Location</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="location_name">Name</label>
                            <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Name">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="num_rows">Rows</label>
                                <input type="number" class="form-control" id="num_rows" name="num_rows">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="num_cols">Columns</label>
                                <input type="number" class="form-control" id="num_cols" name="num_cols">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="height">Height</label>
                                <input type="number" class="form-control" id="height" name="height">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="width">Width</label>
                                <input type="number" class="form-control" id="width" name="width">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="depth">Depth</label>
                                <input type="number" class="form-control" id="depth" name="depth">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="number" class="form-control" id="department" name="department">
                        </div>
                        <div class="form-group">
                            <label for="layout">Layout</label>
                            <textarea rows="5" type="text" class="form-control" id="layout" name="layout" placeholder="[[0],[1,2,3],[4,5,6],[7,8,9,10]]"></textarea>
                            <small class="text-muted form-text"> Layout is expected in nested array format, each sub-array representing a column, with locker number as the value.</small>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                 <button class="btn btn-success btn-block" id="locker-check-in-btn" type="submit">Confirm</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
