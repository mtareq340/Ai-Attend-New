@extends('layouts.vertical', ['title' => 'Datatables'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
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
                                <li class="breadcrumb-item active">Appointments</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Appointments</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @can('add_appointment')
            <button class="btn btn btn-primary">
                 <a href="{{ route('appointment.create')}}" style="color:white"><i class="fa fa-plus"></i> Add Appointment</a>
            </button>
            @endcan
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Appointments</h4>
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location Name</th>
                                        <th>Branch Name</th>
                                        <th>Start from</th>
                                        <th>End to</th>
                                        <th>Daley min</th>
                                        <th>Daly hour</th>
                                        <th>Overtime hour</th>
                                        <th>Overtime min</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>

                                    </tr>
                                </thead>

                               <tbody>
                                @foreach ($appointments as $appoint)
                                <tr>

                                    <td>{{$appoint->name}}</td>
                                    <td>{{$appoint->branch->name}}</td>
                                    <td>{{$appoint->location->name}}</td>
                                    <td>{{$appoint->start_from}}</td>
                                    <td>{{$appoint->end_to}}</td>
                                    <td>{{$appoint->delay_min}}</td>
                                    <td>{{$appoint->delay_hour}}</td>
                                    <td>{{$appoint->overtime_hour}}</td>
                                    <td>{{$appoint->overtime_min}}</td>
                                    <td>{{$appoint->date}}</td>
                                    <td>{{ $appoint->created_at }}</td>
                                    <td>{{ $appoint->updated_at }}</td>
                                    <td>
                                        <div class="row row-xs wd-xl-4p">
                                            @can('edit_appointment')
                                            <a href="{{ route('appointment.edit',$appoint->id) }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            @endcan
                                            {{-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button>  --}}
                                            @can('delete_appointment')
                                            <form action="{{ route('appointment.destroy', $appoint->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button style ="border-color:white; color:red; font-size: 0.8rem;" class="action-icon delete" type="submit"> <i class="mdi mdi-delete"></i></button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

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
   <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>

   <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
   <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
   <!-- Page js-->
   <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>


@endsection
