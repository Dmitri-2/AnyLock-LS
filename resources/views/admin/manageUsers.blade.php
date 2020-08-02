@extends("layouts.master")


@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="my-3 text-center">All Users</h2>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">User ID#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Type</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td class="text-center">{{$user->name}}</td>
                            <td class="text-center">{{$user->email}}</td>
                            <td class="text-center">{!!$user->getIsAdminBadge()!!}</td>
                            <td class="text-center">
                                <form method="POST" action="{{route("userSetAdmin")}}">
                                    @csrf
                                    <input name="user_id" value="{{$user->id}}" hidden>
                                    @if($user->is_admin)
                                        <button type="submit" class="btn btn-danger btn-sm">Remove Admin</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm">Set Admin</button>
                                    @endif
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
