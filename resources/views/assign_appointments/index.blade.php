@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Assign Appointment</li>
                    </ol>
                </div>
                <h4 class="page-title">Assign Appointment</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Assign Appointment</h4>

                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Job Name</th>
                                <th>Branch Name</th>
                                <th>Location Name</th>
                                <th>Appointment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach ($appoints as $a )
                        <tr>
                            <td>{{ $a->employees->name }}</td>
                            <td>{{ $a->job->name }}</td>
                            <td>{{ $a->branch->name }}</td>
                            <td>{{ $a->location->name }}</td>
                            <td>{{ $a->appointment->name }}</td>
                            <td>
                                <div class="row row-xs wd-xl-4p">
                                    @can('edit_assign_appointment')
                                    <a href="{{ route('assign_appointment.edit', $a->id) }}" class="action-icon">
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                    @endcan
                                    <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                    @can('delete_assign_appointment')
                                    <form action="{{ route('assign_appointment.destroy', $a->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button style ="border-color:white; color:red; font-size: 0.8rem;" class="action-icon delete" type="submit"> <i class="mdi mdi-delete"></i></button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div>
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
@endsection
