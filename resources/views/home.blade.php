
@extends("layouts.master")

@section('body')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Homepage</div>

                    <div class="card-body">
                        <p>
                            The best locker system in the galaxy!
                        </p>


                    @guest

                        <h5> You have not logged in! </h5>
                    @else
                        <h5> You're logged in! </h5>

                    @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
