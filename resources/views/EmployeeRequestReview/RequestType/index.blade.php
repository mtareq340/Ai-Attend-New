@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />    
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row align-items-center py-1">
            {{-- <div class="col-12"> --}}
                <div class="col-4">
                    <h4 class="page-title">Request Types</h4>
                </div>
                <div class="col-4">
                    <button class="btn btn btn-primary my-2">
                        <a href="{{ route('employee_request_type.create')}}" style="color:white"><i class="fa fa-plus"></i> Add Request Type</a>
                    </button>
                </div>
                <div class="page-title-box col-4">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Request Type</li>

                        </ol>
                    </div>
                </div>
              

            </div>
        </div>     
        <!-- end page title --> 
     
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- <h4 class="header-title">Employees Request</h4> --}}
                        <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive nowrap w-100">
                                
                            <div class="dt-buttons"></div>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach($types as $type)
                                <tr>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->note }}</td>
                                    <td>
                                        <div class="row row-xs wd-xl-4p">
                                            @can('edit_attend_method')
                                            <a href="{{ route('employee_request_type.edit',$type->id) }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            @endcan
                                            <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                            @can('delete_attend_method')
                                            <form action="{{ route('employee_request_type.destroy',$type->id)}}" method="post">
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
        <!-- end row-->





        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>

    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script>
        var elem = document.querySelectorAll('.js-switch');
        elem.forEach(element => {
            new Switchery(element , {
                size : 'small',
                color : '#64b0f2'
            });
        });   
    </script>
@endsection