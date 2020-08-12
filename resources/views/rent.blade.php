@extends("layouts.master")

@section('body')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        // Globals
        var curLocation = 0;
        var locations = <?php echo json_encode($locations); ?>;
        var layouts = <?php echo json_encode($shapes); ?>;

        var shapes = [];

        for (var i = 0; i < locations.length; i++) {
            shapes.push($.parseJSON(layouts[i]));
        }

        $(function () {

            for (var i = 0; i < locations.length; i++) {
                $("#location").append("<option>" + locations[i] + "</option>");
            }

            for (var i = 1; i < 3; i++) {
                $('#duration').append("<option>" + plusMonth(i) + "</option>");
            }


            $("#location").on("change", function () {

                changeLocation($("#location").find("option").index($("#location").find("option:selected")) - 1);
                getLockersFromLocation().then(data => {
                    var lockerCount = 0;
                    $(".Lockers").html("");
                    for (var i = 0; i < shapes[curLocation].length; i++) {
                        $(".Lockers").append("<div id='locker-col" + i + "' class='col'></div>");
                        for (var j = 0; j < shapes[curLocation][i].length && lockerCount < data.length; j++) {
                            $("#locker-col" + i).append("<label class='locker'><input type='radio' name='id' class='radio-locker' value='" + data[lockerCount]["id"] + "'><span>" + data[lockerCount]["locker_num"] + ": " + data[lockerCount]["status"] + "</span></label><br>");
                            lockerCount++;
                        }
                    }
                });
            });
        });

        function plusMonth(num) {
            var date = new Date();
            if (num > 0) {
                var dateM = new Date(date.setMonth(date.getMonth() + num));
                return dateM.toLocaleString("en-US");
            }

            return 0;
        }

        function changeLocation(num) {
            if (num < shapes.length && num > -1)
                curLocation = num;
        }

        async function getLockersFromLocation() {
            var data = await axios.get("{{route("getLockersLocation")}}" + "/" + locations[curLocation]);
            return data["data"];
        }
    </script>

    <style type="text/css">
        .Locker {
            margin-bottom: fill;
        }
        .radio-locker {
            display: none;
        }

        /*.locker {*/
        /*    display: inline-block;*/
        /*    padding: 5px 10px;*/
        /*    cursor: pointer;*/
        /*    height: 25%;*/
        /*}*/

        .locker span {
            position: relative;
            line-height: 22px;
        }

        .locker span:before, .locker span:after {
            content: '';
        }

        .locker span:before {
            border: 1px solid #222021;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            display: inline-block;
            vertical-align: top;
        }

        .locker span:after {
            background: #222021;
            width: 14px;
            height: 14px;
            position: absolute;
            top: 2px;
            left: 3px;
            transition: 300ms;
            opacity: 0;
        }

        .locker input:checked + span:after {
            opacity: 1;
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header text-center"><h2>Locker Rental Page</h2></div>
            <div class="card-body">
                <div class="text-center"><h4>Select a Locker</h4></div>
                <form action="{{ route('tryRent') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="location">Location</label>
                        <select id="location" name="location" class="form-control">
                            <option selected disabled>Please Select Location</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <div class="Lockers row">
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="duration">Rental Duration</label>
                        <select id="duration" name="duration" class="form-control">
                            <option selected disabled="">Please Select</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>


@endsection
