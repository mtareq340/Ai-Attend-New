@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row align-items-center my-1">
            {{-- <div class="col-12"> --}}
                <div class="col-4">
                    <h4 class="page-title">Users</h4>
                </div>
                <div class="col-4">
                    @can('add_user')
                        <a href="{{ route('users.create')}}" class="btn btn btn-primary waves-effect waves-light" style="color:white"><i class="fa fa-plus"></i> Add Users</a>
                    @endcan
                </div>
                <div class="col-4">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                {{-- <li class="breadcrumb-item"><a href="{{route('users.index')}}">Tables</a></li> --}}
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                        {{-- <h4 class="page-title">Users</h4> --}}
                    </div>
                </div>
                    
                </div>
            {{-- </div> --}}
        </div>
        <!-- end page title -->

       



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- <h4 class="header-title">Users</h4> --}}

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="row row-xs wd-xl-4p">
                                            @can('edit_user')
                                            <a href="{{ route('users.edit', $user->id) }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            @endcan
                                            <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                            @can('delete_user')
                                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button style ="border-color:white; color:red; font-size: 0.8rem;" class="action-icon delete" type="submit"> <i class="mdi mdi-delete"></i></button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{optional($user->branch)->name}}
                                    </td>
                                    <td>
                                        @if ($user->roles->first())
                                            {{$user->roles->first()->name}}
                                        @else
                                            <span class="badge badge-danger">none</span>
                                        @endif

                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone }}</td>
                                    
                                    
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
