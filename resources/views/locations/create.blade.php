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
                        <li class="breadcrumb-item active">Add Location</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Locations</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Form row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Locations</h4> --}}

                    <form id="locationForm" action="{{ route('locations.store') }}" method="post"
                        onsubmit="handleSubmit(event)" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="name" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="inputbrnach" class="col-form-label">Branch *</label>
                                <select name="branch_id" id="inputJob" class="selectize-drop-header"
                                    placeholder="Select a Branch..." required>
                                    @if (auth()->user()->hasRole('super_admin'))
                                        @foreach ($branchs as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ $branchs->id }}">{{ $branchs->name }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputAddress" class="col-form-label">Locations Address</label>
                                <input type="text" name="location_address" class="form-control" id="inputAddress"
                                    placeholder="1234 Main St" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="boundary_radius" class="col-form-label">boundary_radius (m)</label>
                            <input type="number" name="boundary_radius" class="form-control" id="boundary_radius"
                                placeholder="boundary_radius" required>
                        </div>


                        <input hidden type="text" name="location_latitude" class="form-control" id="lat"
                            placeholder="Latitude" required>

                        <input hidden type="text" name="location_longituide" class="form-control" id="lng"
                            placeholder="Longituide" required>

                        <div class="my-4">
                            <div id="map" style="height: 300px"></div>
                        </div>

                        <div class="my-4  px-2">
                            <label>Devices</label>
                            <div class="row">
                                {{-- becon devices --}}
                                <div class="col-md-6 mb-2 bg-light" style="height: 300px;overflow-x: auto">
                                    <p class="text-center font-weight-bold mt-2 h5">Becon devices</p>
                                    <button type="button" onclick="showBeconModal()" id="becon-add-btn"
                                        class="mt-1 btn btn-primary mx-auto waves-effect waves-light"><i
                                            class="fa fa-plus mr-1"></i>Add</button>
                                    <div class="my-1" id="becons"></div>

                                </div>
                                {{-- wifi devices --}}
                                <div class="col-md-6 bg-light" style="height: 300px;overflow-x: auto">
                                    <p class="text-center font-weight-bold mt-2 h5">Wifi devices</p>
                                    <button type="button" onclick="showWifiModal()"
                                        class="mt-1 btn btn-primary mx-auto waves-effect waves-light"><i
                                            class="fa fa-plus mr-1"></i>Add</button>
                                    <div class="my-1" id="wifis"></div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-form-label">Note</label>
                            {{-- <input type="text" name="lon" class="form-control" id="locationlatitude" placeholder="Password"> --}}
                            <textarea name="notes" class="form-control" id="note" cols="30" rows="10"></textarea>
                        </div>
                        <center><button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
                        </center>

                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


    {{-- becon modal --}}
    <div class="modal fade" id="becon-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Becon Device</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Becon code</label>
                        <input id="becon-code" type="text" class="form-control" />
                    </div>
                    <button type="button" onclick="addBeconDevice()" class="btn btn-secondary">Add</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    {{-- wifi modal --}}
    <div class="modal fade" id="wifi-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Wifi Device</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Wifi ssid</label>
                        <input id="wifi-ssid" type="text" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Wifi bssid</label>
                        <input id="wifi-bssid" type="text" class="form-control" />
                    </div>


                    <button type="button" onclick="addWifiDevice()" class="btn btn-secondary">Add</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection
@section('script')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js') }}"></script>
    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
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

        let devices = []

        const showBeconModal = () => {
            $('#becon-modal').modal('show')
        }
        const showWifiModal = () => {
            $('#wifi-modal').modal('show')
        }

        const showDevices = () => {
            $('#becons').empty()
            $('#wifis').empty()


            devices.forEach(device => {
                if (device.code) {
                    // becon
                    $('#becons').append(
                        `
                <div class="my-1 p-2 bg-white justify-content-between align-items-center d-flex">
                  <div>
                    <i class="icon-mouse"></i>
                    <span class="ml-1">becon-${device.code}</span>
                  </div>
                    <button class="btn btn-danger" onclick="deleteBecon('${device.code}')">
                    <i class="fa fa-trash "></i>
                    </button>
                </div>
                `
                    )
                } else {
                    // wifi
                    $('#wifis').append(
                        `
                <div class="my-1 p-2 bg-white justify-content-between align-items-center d-flex">
                  <div>
                    <i class="fa fa-wifi"></i>
                    <p class="m-0">wifi-${device.ssid} (ssid)</p>
                    <p class="m-0">wifi-${device.bssid} (bssid)</p>
                  </div>
                    <button class="btn btn-danger" onclick="deletewifi('${device.ssid}')">
                    <i class="fa fa-trash "></i>
                    </button>
                </div>
                `
                    )
                }
            });
        }

        const addBeconDevice = () => {
            const code = $('#becon-code').val()
            if (!code) return

            devices.push({
                code,
                type: 'becon'
            })

            // show the becon device
            showDevices()

            $('#becon-code').val('')
            $('#becon-modal').modal('hide')
        }

        const addWifiDevice = () => {
            const ssid = $('#wifi-ssid').val()
            const bssid = $('#wifi-bssid').val()
            if (!ssid || !bssid) return

            devices.push({
                ssid,
                bssid,
                type: 'wifi'
            })

            // show the becon device
            showDevices()


            $('#wifi-ssid').val('')
            $('#wifi-bssid').val('')
            $('#wifi-modal').modal('hide')

        }

        const deleteBecon = (code) => {
            devices = devices.filter(device => {
                if ((device.code && device.code != code) || device.ssid) return true
            })


            showDevices()
        }

        const deletewifi = (ssid) => {
            devices = devices.filter(device => {
                if ((device.ssid && device.ssid != ssid) || device.code) return true
            })
            showDevices()
        }


        const handleSubmit = (event) => {
            event.stopImmediatePropagation()
            event.preventDefault()

            var values = {};
            $.each($(`#locationForm`).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });


            values['devices'] = devices
            $.ajax({
                type: 'POST',
                url: "{{ route('locations.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: JSON.stringify(values),
                success: function(data) {
                    notyf.success('???? ?????????????????????? ??????????')
                    window.location = '/dashboard/locations'
                },
                error: function(error) {
                    const msg = error.responseJSON.msg
                    notyf.error(msg)
                },
                processData: false,

            });

        }

    </script>
@endsection
