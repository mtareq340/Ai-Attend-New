@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" @endsection
    @section('content') @if (session()->has('message')) {{ dd('vbnm') }}
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div> @endif <!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Locations</a></li>
                        <li class="breadcrumb-item active">Edit Location</li>

                    </ol>
                </div>
                <h4 class="page-title">Update Locations</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Locations</h4>

                    <form action="{{ route('locations.update', $location->id) }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        {{-- <input type="hidden" name="id" value="{{$location->id}}"> --}}
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="name" value="{{ $location->name }}" name="name" class="form-control"
                                id="name" placeholder="Name" required>
                        </div>

                        <div class="form-group">
                            <label for="inputbrnach" class="col-form-label">Branch *</label>
                            <select name="branch_id" id="inputbranch" class="selectize-drop-header"
                                placeholder="Select a Branch..." required>
                                @if (auth()->user()->hasRole('super_admin'))
                                    <option selected value="{{ $selected_branch->id }}">
                                        {{ $selected_branch->name }}</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                @else
                                    <option selected value="{{ $branchs->id }}">{{ $branchs->name }}</option>
                                @endif
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="inputAddress" class="col-form-label">Locations Address</label>
                            <input type="text" value="{{ $location->location_address }}" name="location_address"
                                class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>

                        <div class="form-group">
                            <label for="distance" class="col-form-label">Distance</label>
                            <input type="text" value="{{ $location->distance }}" name="distance" class="form-control"
                                id="distance" placeholder="Distance" required>
                        </div>


                        <input type="text" value="{{ $location->location_latitude }}" name="location_latitude"
                            class="form-control" id="lat" placeholder="Latitude" hidden>

                        <input type="text" value="{{ $location->location_longituide }}" name="location_longituide"
                            class="form-control" id="lng" placeholder="Longituide" hidden>
                        <div class="my-4">
                            <div id="map" style="height: 500px"></div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-form-label">Note</label>
                            {{-- <input type="text" name="lon" class="form-control" id="locationlatitude" placeholder="Password"> --}}
                            <textarea name="notes" class="form-control" id="note" cols="30"
                                rows="10">{{ $location->notes }}</textarea>
                        </div>
                        <center><button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                        </center>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


@endsection
@section('script')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js') }}"></script>
    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn1ZmThbXMe-8C-boHXrWFupCBpT8LmnU">
    </script>
    <script>
        window.onload = function() {
            var latlng = new google.maps.LatLng($('#lat').val(), $('#lng').val());
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
