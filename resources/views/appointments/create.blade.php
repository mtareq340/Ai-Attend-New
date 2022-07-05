@extends('layouts.vertical', ['title' => 'Form Wizard'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <form id="profileForm" method="post" action="{{ route('appointment.store') }}" class="form-horizontal">
            @csrf

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Wizard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Form Wizard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title mb-3"> Wizard With Form Validation</h4>

                            <div id="rootwizard">
                                <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                    <li class="nav-item" data-target-form="#accountForm">
                                        <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-account-circle mr-1"></i>
                                            <span class="d-none d-sm-inline">Appointment</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#profileForm">
                                        <a href="#second" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-face-profile mr-1"></i>
                                            <span class="d-none d-sm-inline">Location & Devices</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#otherForm">
                                        <a href="#third" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                            <span class="d-none d-sm-inline">Employees</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content mb-0 b-0 pt-0">


                                    <div class="tab-pane" id="first">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="userName3">Periods</label>
                                                    <div class="col-md-9">
                                                        <div class="form-group mb-3">

                                                            <div class="radio form-check-inline">
                                                                <input type="radio" onchange="handlePeriodChange(event)"
                                                                    id="inlineRadio1" value="1" name="radioInline"
                                                                    checked="">
                                                                <label for="inlineRadio1"> One </label>
                                                            </div>
                                                            <div class="radio form-check-inline">
                                                                <input type="radio" onchange="handlePeriodChange(event)"
                                                                    id="inlineRadio2" value="2" name="radioInline">
                                                                <label for="inlineRadio2"> Two </label>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- first period --}}
                                                <div class="form-group row mb-3 bg-light py-3" id="first-period">
                                                    <label class="col-md-3 col-form-label" for="userName3">the first
                                                        period</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-town-city">Start Time</label>
                                                                    <input type="time" id="preloading-timepicker"
                                                                        class="form-control" placeholder="Pick a time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-state"> End Time</label>
                                                                    <input class="form-control" type="time"
                                                                        placeholder="Enter your End Time"
                                                                        id="billing-state" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-zip-postal">Delay Period</label>
                                                                    <input class="form-control" type="time"
                                                                        placeholder="Enter your Delay Period"
                                                                        id="billing-zip-postal" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div>
                                                </div>
                                                {{-- second period --}}
                                                <div class="form-group row mb-3 bg-light py-3 d-none" id="second-period">
                                                    <label class="col-md-3 col-form-label" for="userName3">the second
                                                        period</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-town-city">Start Time</label>
                                                                    <input type="time" id="preloading-timepicker"
                                                                        class="form-control" placeholder="Pick a time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-state"> End Time</label>
                                                                    <input class="form-control" type="time"
                                                                        placeholder="Enter your End Time"
                                                                        id="billing-state" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-zip-postal">Delay Period</label>
                                                                    <input class="form-control" type="time"
                                                                        placeholder="Enter your Delay Period"
                                                                        id="billing-zip-postal" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div>
                                                </div>
                                                {{-- /////////////////// --}}



                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="password3"> Attendance
                                                        Days</label>
                                                    <div class="col-md-9">

                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="" value="option1">
                                                            <label for="inlineCheckbox2"> Saturday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="" value="option1">
                                                            <label for="inlineCheckbox2"> Sunday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1">
                                                            <label for="inlineCheckbox2"> Monday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1">
                                                            <label for="inlineCheckbox2"> Tuesday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1"
                                                                checked>
                                                            <label for="inlineCheckbox2"> Wednesday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1"
                                                                checked>
                                                            <label for="inlineCheckbox2"> Thursday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1"
                                                                checked>
                                                            <label for="inlineCheckbox2"> Friday </label>
                                                        </div>



                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="confirm3">repeat</label>
                                                    <div class="col-md-9">
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1"
                                                                checked>
                                                            <label for="inlineCheckbox2"> repeat </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                    <div class="tab-pane fade" id="second">
                                        <div class="row">

                                            <div class="form-group mb-2 w-100">
                                                <label for="inputLocation">Location *</label>
                                                <select id="inputLocation" onchange="getLocationDevices(event)"
                                                    data-toggle="select2" class="select2" name="location_id">
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}">{{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group w-100">
                                                <label for="devices_input">Devices</label>
                                                <select name="devices[]" id="devices_input"
                                                    class="form-control select2-multiple" data-toggle="select2"
                                                    multiple="multiple" data-placeholder="Choose ...">
                                                </select>

                                            </div>


                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <div class="tab-pane fade" id="third">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <div class="row">
                                                        <div class="form-group col-md-5">
                                                            <label for="job_id_input">Job</label>
                                                            <select id="job_id_input" data-toggle="select2"
                                                                onchange="getJobEmployees(event)" class="select2">
                                                                @foreach ($jobs as $job)
                                                                    <option value="{{ $job->id }}">{{ $job->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <table id="demo-custom-toolbar" class="appointments-emp-table" data-toggle="table" data-search="true"
                                                        data-sort-name="id" data-page-size="1000">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th></th>
                                                                <th data-field="id" data-sortable="true">Job
                                                                    number
                                                                </th>
                                                                <th data-field="job" data-sortable="true">Job</th>
                                                                <th data-field="name" data-sortable="true">Name</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($employees as $emp)
                                                                <tr>
                                                                    <td>
                                                                        <div
                                                                            class="checkbox checkbox-success form-check-inline">
                                                                            <input type="checkbox"
                                                                                id="checkbox-{{ $emp->id }}"
                                                                                name="emp_ids[]"
                                                                                value="{{ $emp->id }}">
                                                                            <label for="checkbox-{{ $emp->id }}"
                                                                                class="w-100"></label>
                                                                        </div>

                                                                    </td>
                                                                    <td>{{ $emp->job_number }}</td>
                                                                    <td>{{ $emp->job->name }}</td>

                                                                    <td>{{ $emp->name }}</td>

                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div> <!-- end card-box-->
                                            </div> <!-- end col-->
                                        </div>
                                    </div>

                                    <ul class="list-inline wizard mb-0">
                                        <li d="prev" class="previous list-inline-item"><a href="javascript: void(0);"
                                                class="btn btn-secondary">Previous</a>
                                        </li>

                                        <li id="next" class="next list-inline-item float-right"><a
                                                href="javascript: void(0);" class="btn btn-secondary">Next</a></li>
                                        <li id="submit-btn" class="list-inline-item float-right d-none">
                                            <input type="submit" value="Add appointment"
                                                class="btn btn-success waves-light waves-effect" />
                                        </li>

                                    </ul>


                                    {{-- end form --}}

                                </div> <!-- tab-content -->
                            </div> <!-- end #rootwizard-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </form>
    </div> <!-- container -->
@endsection

@section('script')

    <script>
        const clearDevices = () => {
            $('#devices_input').val([])
        }
        $('#inputLocation').val('')
        const getLocationDevices = (event) => {
            const id = event.target.value
            $.ajax({
                url: "{{ route('getLocationDevices') }}",
                type: 'GET',
                data: {
                    location_id: id
                },
                success: (res) => {
                    const $devices_select = $('#devices_input')
                    $devices_select.empty()
                    res.forEach(device => {
                        $devices_select.append(
                            new Option(
                                device.name,
                                device.id,
                                false,
                                false
                            )
                        )
                    });


                },
                error: () => {
                    alert('something went wrong try again later')
                }
            });

        }


        // handle filter employee
        $('#job_id_input').val('')
        const getJobEmployees = (event) => {
            const job_id = event.target.value
            $.ajax({
                url: "{{ route('getEmployeesByJob') }}",
                type: 'GET',
                data: {
                    job_id
                },
                success: (res) => {
                    $('.appointments-emp-table tbody').empty()

                    res.forEach((emp) => {
                        const row = `
                            <tr>
                                <td>
                                    <div
                                        class="checkbox checkbox-success form-check-inline">
                                        <input type="checkbox"
                                            id="checkbox-${emp.id}"
                                            name="emp_ids[]"
                                            value="${emp.id}">
                                        <label for="checkbox-${emp.id}"
                                            class="w-100"></label>
                                    </div>
                                </td>
                                <td>${emp.job_number}</td>
                                <td>${emp.job.name}</td>
                                <td>${emp.name}</td>
                            </tr>   
                            `
                        $('.appointments-emp-table tbody').append(row)
                        
                    })
                },
                error: () => {
                    alert('something went wrong try again later')
                }
            });
        }

    </script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js') }}"></script>
    {{-- init the wizard --}}
    <script>
        $('#rootwizard').bootstrapWizard({
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                if ($total == $current) {
                    // last tab
                    $('#next').addClass('d-none')
                    $('#submit-btn').removeClass('d-none')
                } else {
                    // other tabs
                    $('#next').removeClass('d-none')
                    $('#submit-btn').addClass('d-none')
                }
            }
        });

    </script>
    <!-- Page js-->
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/bootstrap-tables.init.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script>
        const handlePeriodChange = (event) => {
            if (event.target.value == 2) {
                $('#second-period').removeClass('d-none')
                return
            }
            $('#second-period').addClass('d-none')
        }

    </script>

@endsection
