@extends('layouts.vertical', ['title' => 'Form Components'])

@section('content')


    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('branches.index') }}">Branchs</a></li>
                            <li class="breadcrumb-item active">Add New Branch</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Branch</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('branches.store') }}" method="post" class="needs-validation" novalidate>
                         @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name @include('red_star')</label>
                                <input type="name"  name="name" class="form-control" id="name"
                                    placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <label for="inputphone" class="col-form-label">Phone number</label>
                                <input type="tel"  name="phone" class="form-control"
                                    id="inputphone" placeholder="branch phone number" required>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Address <span
                                        class="text-muted">(optional)</span></label>
                                <input type="text"  name="address" class="form-control"
                                    id="inputAddress" placeholder="1234 Main St">
                            </div>

                            <input hidden type="text" name="latitude" class="form-control" id="lat"
                            placeholder="Latitude" required>

                        <input hidden type="text" name="longituide" class="form-control" id="lng"
                            placeholder="Longituide" required>


                            <div class="my-4">
                                <div id="map" style="height: 300px"></div>
                            </div>

                            <div class="form-group">
                                <label for="inputNotes" class="col-form-label">Notes <span
                                        class="text-muted">(optional)</span></label>
                                <input type="text"  name="notes" class="form-control"
                                    id="inputNotes" placeholder="...">
                            </div>

                            <center> <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                            </center>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->



    </div> <!-- container -->
@endsection
@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn1ZmThbXMe-8C-boHXrWFupCBpT8LmnU">
</script>
<script>
         window.onload = function() {
            $('#lat').val(30.0444)
            $('#lng').val(31.2357)
            var latlng = new google.maps.LatLng(30.0444, 31.2357);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function(a) {
                var lat = a.latLng.lat();
                var lng = a.latLng.lng();
                $('#lat').val(lat)
                $('#lng').val(lng)

            });
        };

</script>
@endsection
