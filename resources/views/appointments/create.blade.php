@extends('layouts.vertical', ['title' => 'Form Wizard'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <form id="appointmentForm" onsubmit="handleSubmitForm(event)" method="post"
            action="{{ route('appointment.store') }}" class="form-horizontal">
            @csrf

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('appointment.index') }}">Appointments</a>
                                </li>
                                <li class="breadcrumb-item active">Add Appointments</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Appointments</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- <h4 class="header-title mb-3"> Wizard With Form Validation</h4> --}}

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
                                                    <label for="name_input">Appointment name</label>
                                                    <input type="text" name="name" id="name_input" class="form-control" />
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for="date_input">Date</label>
                                                    <input type="text" name="date" id="date_input" class="form-control"
                                                        data-provide="datepicker">
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="userName3">Periods</label>
                                                    <div class="col-md-9">
                                                        <div class="form-group mb-3">

                                                            <div class="radio form-check-inline">
                                                                <input type="radio" onchange="handlePeriodChange(event)"
                                                                    id="inlineRadio1" value="1" name="period_count"
                                                                    checked="">
                                                                <label for="inlineRadio1"> One </label>
                                                            </div>
                                                            <div class="radio form-check-inline">
                                                                <input type="radio" onchange="handlePeriodChange(event)"
                                                                    id="inlineRadio2" value="2" name="period_count">
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
                                                                    <label for="start_from_period_1_input">Start
                                                                        Time</label>
                                                                    <input type="time" id="start_from_period_1_input"
                                                                        class="form-control" name="start_from_period_1"
                                                                        placeholder="Pick a time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="end_to_period_1_input"> End Time</label>
                                                                    <input class="form-control" type="time"
                                                                        placeholder="Enter your End Time"
                                                                        name="end_to_period_1" id="end_to_period_1_input" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="delay_period_1_input">Delay Period</label>
                                                                    <input type="text" id="delay_period_1_input"
                                                                        name="delay_period_1"
                                                                        class="24hours-timepicker form-control"
                                                                        placeholder="00:00">
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
                                                                    <label for="start_from_period_2_input">Start
                                                                        Time</label>
                                                                    <input type="time" id="start_from_period_2_input"
                                                                        class="form-control" name="start_from_period_2"
                                                                        placeholder="Pick a time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="end_to_period_2_input"> End Time</label>
                                                                    <input class="form-control" type="time"
                                                                        placeholder="Enter your End Time"
                                                                        name="end_to_period_2" id="end_to_period_2_input" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="delay_period_2_input">Delay Period</label>
                                                                    <input type="text" id="delay_period_2_input"
                                                                        name="delay_period_2"
                                                                        class="24hours-timepicker form-control"
                                                                        placeholder="00:00">
                                                                </div>
                                                            </div>


                                                        </div> <!-- end row -->
                                                    </div>
                                                </div>
                                                {{-- /////////////////// --}}


                                                <div class="form-group mb-3">
                                                    <label for="overtime_input">overtime</label>
                                                    <input type="text" id="overtime_input" name="overtime"
                                                        class="24hours-timepicker form-control" placeholder="00:00">
                                                </div>

                                                <div class="form-group row mb-3">

                                                    <label class="col-md-3 col-form-label" for="password3"> Attendance
                                                        Days</label>

                                                    <div class="col-md-9">
                                                        @foreach ($days as $day)
                                                            <div class="checkbox checkbox-success form-check-inline">
                                                                <input {{ $day->id == 7 ? '' : 'checked' }}
                                                                    name="attendance_days" type="checkbox"
                                                                    id="day-{{ $day->id }}"
                                                                    value="{{ $day->id }}">
                                                                <label
                                                                    for="day-{{ $day->id }}">{{ $day->days }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label">repeat</label>
                                                    <div class="col-md-9">
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="repeat-checkbox" value="1"
                                                                name="attendance_repeat" checked>
                                                            <label for="repeat-checkbox"> repeat </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                    <div class="tab-pane fade" id="second">
                                        <div class="row">

                                            <div class="form-group mb-2 w-100">
                                                <label for="inputBranch">Branch *</label>
                                                <select onchange="getBranchLocations(event)" id="inputBranch"
                                                    data-toggle="select2" class="select2" name="branch_id">
                                                    @if (auth()->user()->hasRole('super_admin'))
                                                        @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option selected value="{{ $branches->id }}">
                                                            {{ $branches->name }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group mb-2 w-100">
                                                <label for="inputLocation">Location *</label>
                                                <select id="inputLocation" onchange="getdevicesFromLocation(event)"
                                                    data-toggle="select2" class="select2" name="location_id"
                                                    data-placeholder="Choose ...">

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
                                                                <option value="">All</option>
                                                                @foreach ($jobs as $job)
                                                                    <option value="{{ $job->name }}">
                                                                        {{ $job->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <label class="mt-2 h4">Employees</label>
                                                    <table id="state-saving-datatable"
                                                        class="table appointments-emp-table activate-select dt-responsive nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <div
                                                                        class="checkbox checkbox-success form-check-inline">
                                                                        <input onchange="selectAllEmps(event)"
                                                                            type="checkbox" id="selectall">
                                                                        <label for="selectall"></label>
                                                                    </div>
                                                                </th>
                                                                <th>Job number</th>
                                                                <th>Job</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($employees as $emp)
                                                                <tr>
                                                                    <td style="width:10%">
                                                                        <div
                                                                            class="checkbox checkbox-success form-check-inline">
                                                                            <input type="checkbox"
                                                                                id="checkbox-{{ $emp->id }}"
                                                                                name="emps"
                                                                                value="{{ json_encode(['id' => $emp->id, 'job_id' => $emp->job_id]) }}">
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

    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>

    <script>
        $('#inputLocation').val('')
        $('#inputBranch').val('')
        const getdevicesFromLocation = (event) => {
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
                                device.type == 'becon' ? `becon-${device.code}` :
                                `wifi-${device.ssid}`,
                                device.id,
                                false,
                                false
                            )
                        )
                    });
                    $devices_select.val('')
                },
                error: () => {
                    alert('something went wrong try again later')
                }
            });
        }


        const getBranchLocations = (event) => {
            const id = event.target.value
            $.ajax({
                url: "{{ route('getBranchLocations') }}",
                type: 'GET',
                data: {
                    branch_id: id
                },
                success: (res) => {
                    const $locations_select = $('#inputLocation')
                    $locations_select.empty()
                    $('#devices_input').empty()
                    res.forEach(location => {
                        $locations_select.append(
                            new Option(
                                location.name,
                                location.id,
                                false,
                                false
                            )
                        )
                    });

                    $('#inputLocation').val('')


                },
                error: () => {
                    alert('something went wrong try again later')
                }
            });
        }

    </script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/bootstrap-tables.init.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script>
        // init 24 hours , minutes
        $('.24hours-timepicker').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        // handl moving forward and backward
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




        // clear state
        localStorage.removeItem('DataTables_state-saving-datatable_/{{ Request::path() }}');
        // adjust header with the body
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        // Default Datatable
        const emptable = $('#state-saving-datatable').DataTable({
            stateSave: true,
            scrollX: true,
            scrollY: '300px',
            paging: false,
            bInfo: false
        });


        // handle filter employee
        $('#job_id_input').val('')
        const getJobEmployees = (event) => {
            const job = event.target.value
            emptable.search(job).draw()
        }

        //handl toggle one period and two periods
        const handlePeriodChange = (event) => {
            if (event.target.value == 2) {
                $('#second-period').removeClass('d-none')
                return
            }
            $('#second-period').addClass('d-none')
        }


        // select all visible employees
        const selectAllEmps = (event) => {
            var cells = emptable.column(0, {
                    'filter': 'applied'
                }).nodes(), // Cells from 1st column
                state = event.target.checked ? true : false;

            console.log(state);
            // select all visible
            for (var i = 0; i < cells.length; i += 1) {
                const checkbox = cells[i].querySelector("input[type='checkbox']")
                checkbox.checked = state;
            }
            // emptable.draw()
        }


        // submit the form
        const handleSubmitForm = (event) => {
            event.stopImmediatePropagation()
            event.preventDefault()
            emptable.search('').draw()

            var values = {};
            $.each($(`#appointmentForm`).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            var emps = $("input[name='emps[]']")
                .map(function() {
                    return $(this).val();
                }).get();


            var devices = $("#devices_input")
                .map(function() {
                    return $(this).val();
                }).get();


            var emps = []
            $("input:checkbox[name=emps]:checked").each(function() {
                emps.push($(this).val());
            });

            var attendance_days = []
            $("input:checkbox[name=attendance_days]:checked").each(function() {
                attendance_days.push($(this).val());
            });

            values['emps'] = emps
            values['devices'] = devices
            values['attendance_days'] = attendance_days
            $.ajax({
                type: 'POST',
                url: "{{ route('appointment.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: JSON.stringify(values),
                success: function(data) {
                    notyf.success('تم اضافة خطة الدوام بنجاح')
                    window.location = '/dashboard/appointment'
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
