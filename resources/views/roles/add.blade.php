@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .selectize-dropdown-header {
            display: none !important
        }

    </style>
@endsection
@section('content')

    @if (session()->has('message'))
        {{ dd('vbnm') }}
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
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                            <li class="breadcrumb-item active">Add Roles</li>
                        </ol>
                    </div>
                    <h4 class="page-title">create a new role</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('roles.store') }}" method="post" autocomplete="off" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name-input" class="col-form-label">Name *</label>
                                <input type="text" name="name" class="form-control" id="name-input" placeholder="Name"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="inputnotes" class="col-form-label">Notes <span
                                        class="text-muted font-weight-light">(optional)</span></label>
                                <textarea class="form-control" id="inputnotes" name="notes"></textarea>
                            </div>


                            <div class="form-group">

                                <label class="col-form-label">Permissions</label>
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-primary mb-2">
                                        <input type="checkbox" name="select-all" id="select-all" >
                                        <label for="select-all">check all</label>
                                    </div>
                                </div>

                                <div class="row gx-2 mt-4">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-4 bg-white">
                                                <div class="">
                                                    <div class="checkbox checkbox-primary mb-2">
                                                        <input id="{{ $permission->id }}" type="checkbox"
                                                            value="{{ $permission->id }}" name="permissions[]">
                                                        <label for="{{ $permission->id }}">{{ $permission->display_name }}</label>
                                                    </div>
                                                </div>
                                        </div> <!-- end col-->
                                    @endforeach
                                </div>
                                <!-- end row-->
                            </div>

                            <center><button type="submit" class="btn btn-success waves-effect waves-light">Add</button>
                            </center>

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
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script>
        $('#select-all').click(function(event) {
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    </script>
@endsection
