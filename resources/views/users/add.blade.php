@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
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

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Elements</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add User</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Users</h4>
                      
                        <form action="{{ route('users.store')}}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="name" name="name" class="form-control" id="name" placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail4" class="col-form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                            </div>
                          
                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPhone" class="col-form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="010" required>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword4" class="col-form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
                            </div>


                            <div class="form-group">
                                <label for="roleInput" class="col-form-label">Role</label>
                                <select name="role_id" id="roleInput" class="selectize-drop-header" placeholder="Select a role..." required>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <center><button type="submit" class="btn btn-success waves-effect waves-light">Add</button></center>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


        
    </div> <!-- container -->
@endsection
@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
@endsection