@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attend Method</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Employees attend methods</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive w-100">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Employee Name</th>
                                    <th>Employee Branch</th>
                                    <th>Employee Job</th>
                                    <th>Attend Methods</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emps as $emp)
                                <tr>
                                <td class="px-5 py-0">
                                    @can('edit_employee_attend_method')
                                    <a href="/dashboard/employees_attend_methods/{{$emp->id}}/edit" type="button" class="btn btn-blue waves-effect waves-light">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    @endcan
                                </td>
                                <td>{{$emp->name}}</td>
                                    <td>{{$emp->branch->name}}</td>
                                    <td>{{$emp->job->name}}</td>
                                    <td>
                                        <ul class="list">
                                            @foreach ($emp->attend_methods as $attend_method)
                                                    <li>{{$attend_method->name}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

@endsection
