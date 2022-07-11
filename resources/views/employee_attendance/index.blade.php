@extends('layouts.vertical', ['title' => 'Datatables'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee Attendance</li>
                        </ol>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="page-title">Employee Attendance</h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('employee_attendance.create') }}"
                                class="btn btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Add
                                Employee Attendance Manullay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">locations</h4> --}}
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Job Number</th>
                                    <th>Branch Name</th>
                                    <th>Attendance Method</th>
                                    <th>State</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $emp)
                                    <tr>
                                        <td>{{$emp->employee->name}}</td>
                                        <td>{{$emp->employee->job_number}}</td>
                                        <td>{{$emp->branch->name}}</td>
                                        <td>{{$emp->attendanc_method->name}}</td>
                                        <td>
                                            @if ($emp->states)
                                                <p class="badge badge-success badge-pill" style="font-size: 12px">Success</p>
                                            @else
                                                <p class="badge badge-danger badge-pill" style="font-size: 12px">Fail</p>
                                            @endif
                                            {{-- {{$emp->state}} --}}
                                        </td>
                                        <td>{{$emp->created_at}}</td>
                                        <td>{{$emp->updated_at}}</td>
                                        <td></td>
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

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        // $('#rootwizard').bootstrapWizard({
        //     // onTabShow: function(tab, navigation, index) {
        //     //     var $total = navigation.find('li').length;
        //     //     var $current = index + 1;

        //     //     if ($total == $current) {
        //     //         // last tab
        //     //         $('#next').addClass('d-none')
        //     //         $('#submit-btn').removeClass('d-none')
        //     //     } else {
        //     //         // other tabs
        //     //         $('#next').removeClass('d-none')
        //     //         $('#submit-btn').addClass('d-none')
        //     //     }
        //     // }
        // });
        
    </script>

@endsection
