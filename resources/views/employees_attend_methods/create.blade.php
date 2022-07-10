@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
type="text/css" />
<link href="{{ asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
type="text/css" />    <style>
        .selectize-dropdown-header{
            display : none !important
        }
    </style>
@endsection

@section('content')

@if(session()->has('message'))
{{dd('vbnm')}}
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<form action="{{route('employees_attend_methods.store')}}" method="POST">
@csrf
<div class="container-fluid">

     <!-- start page title -->
     <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('attend_methods.index')}}">Attend Methods</a></li>
                        <li class="breadcrumb-item active">Add Attend Method</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Employees Attends Method</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">

  
        <div class="form-group col-md-4">
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

        <div class="form-group col-md-4">
            <label for="attend_id_input">Attend Methods</label>
            <select id="select2-multiple" name="attendance_id[]" class="selectatt form-control select2-multiple select2-hidden-accessible" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." data-select2-id="4" tabindex="-1" aria-hidden="true">
                {{-- <option value="">All</option> --}}
                @foreach ($attendmethods as $attendmethod)
                    <option value="{{ $attendmethod->id }}">
                        {{ $attendmethod->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        
        <div class="col-xl-12">
        <div class="card pl-2 px-2 pt-2" id="rootwizard">
                            
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
                        <td style="width: 5%">
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
            </div>


        </div> 
    </div>
    <li id="submit-btn" class="list-inline-item float-right ">
        <input type="submit" value="Add appointment"
            class="btn btn-success waves-light waves-effect" />
    </li>


</div>
</form>

@endsection

@section('script')

<script>
    $(".selectatt").on('change', function(e) {
    if (Object.keys($(this).val()).length > 3) {
        $('option[value="' + $(this).val().toString().split(',')[3] + '"]').prop('selected', false);
    }
});
</script>
    <!-- Plugins js-->
        <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
        <!-- Page js-->
        <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>

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

        // datatable
        // clear state
        localStorage.removeItem('DataTables_state-saving-datatable_/{{ Request::path()  }}');
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

        </script>

@endsection