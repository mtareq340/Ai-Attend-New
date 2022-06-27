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
                            <li class="breadcrumb-item active">Devices</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Datatables</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <button class="btn btn btn-primary">
            <a href="{{ route('devices.create')}}" style="color:white"><i class="fa fa-plus"></i> Add Device</a>
        </button>
        

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Devices</h4>
                      
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach($devices  as $device)
                                    <tr>
                                        <td>{{ $device->name }}</td>
                                        <td>{{ $device->notes }}</td>
                                        <td> 
                                            <div class="row row-xs wd-xl-4p">
                                                <a href="{{ route('devices.edit', $device->id) }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i> </a>
                                                <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                                <form action="{{ route('devices.destroy', $device->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style ="border-color:white; color:red; font-size: 0.8rem;" class="action-icon delete" type="submit"> <i class="mdi mdi-delete"></i></button>
                                                </form>
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