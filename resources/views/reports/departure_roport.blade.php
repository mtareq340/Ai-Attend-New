@extends('layouts.vertical', ['title' => 'Datatables'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center pt-1">
            <div class="col-6">
                <h4 class="page-title">Departure Report</h4>
            </div>

            <div class="page-title-box col-6">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Departure Report</li>
                    </ol>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="row">
        <div class="form-group col-4">
            <select name="employee_id" id="employees" class="form-control select2">
                <option value="" selected>Select Employee</option>
                @foreach ($employees as $employee)
                    <option {{ app('request')->input('employee_id') == $employee->id ? 'selected' : '' }}
                        value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-4">
            <input type="date" name="date" id="date" class="form-control" value="{{app('request')->input('date') ?? ''}}">
        </div>

        <div class="form-group col-4">
            <button id="searchBtn" class="btn btn-primary">Search</button>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">locations</h4> --}}
                    <table id="datatable-buttons" class="table table-striped nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Job Number</th>
                                <th>Departure Plan</th>
                                <th>Branch Name</th>
                                <th>Date</th>
                                <th>Overtime</th>
                                <th>Created By</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($employeeDepartures as $empDeparture)
                                <tr>
                                    <td>{{ $empDeparture->employee->name }}</td>
                                    <td>{{ $empDeparture->employee->job_number }}</td>
                                    <td>{{ $empDeparture->appointment->name }}</td>
                                    <td>{{ $empDeparture->branch->name }}</td>
                                    <td>{{ $empDeparture->date }}</td>
                                    <td>{{ $empDeparture->overtime }}</td>
                                    <td>{{ $empDeparture->user_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div>

@endsection

@section('script')
    <!-- Plugins js-->

    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        $("#searchBtn").on('click',function(){
            window.location = "{{ route('reports.departure-report') }}?employee_id=" + $('#employees').val()+"&date="+ $('#date').val()
        });
    </script>
@endsection
