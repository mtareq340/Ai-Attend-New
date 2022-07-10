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
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            <li class="nav-item" data-target-form="#profileForm">
                                <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile mr-1"></i>
                                    <span class="d-none d-sm-inline">Success</span>
                                </a>
                            </li>
                            <li class="nav-item" data-target-form="#otherForm">
                                <a href="#secound" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                    <span class="d-none d-sm-inline">Fail</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-pane fade" id="first">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Job Number</th>
                                    <th>Branch Name</th>
                                    <th>Attendance Method</th>
                                    <th>State</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $emp)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{$emp->employee->name}}</td>
                                        <td>{{$emp->employee->job_number}}</td>
                                        <td>{{$emp->branch->name}}</td>
                                        <td>{{$emp->attendanc_method->name}}</td>
                                        <td>
                                            @if ($emp->state == 1)
                                                <p class="badge badge-success badge-pill" style="font-size: 15px">Success</p>
                                            @else
                                                <p class="badge badge-danger badge-pill" style="font-size: 15px">Fail</p>
                                            @endif
                                            {{-- {{$emp->state}} --}}
                                        </td>
                                        <td>{{$emp->created_at}}</td>
                                        <td>{{$emp->updated_at}}</td>
                                        {{-- <td>
                                            <div class="row row-xs wd-xl-4p">
                                                @can('edit_employee')
                                                    <a href="{{ route('employee_attendance.edit', $emp->id) }}" class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                @endcan
                                                <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                                @can('delete_employee')
                                                    <form action="{{ route('employee_attendance.destroy', $emp->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="border-color:white; color:red; font-size: 0.8rem;"
                                                            class="action-icon delete" type="submit"> <i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>                    
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
