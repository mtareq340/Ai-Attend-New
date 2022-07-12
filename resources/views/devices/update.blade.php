@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Devices</a></li>
                            <li class="breadcrumb-item active">Edit Devices</li>

                        </ol>
                    </div>
                    <h4 class="page-title">Edit devices</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">Devices</h4> --}}

                        <form action="{{ route('devices.update', $device->id) }}" method="post" class="needs-validation"
                            novalidate>
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group">
                                <label for="name" class="col-form-label">Name *</label>
                                <input type="name" value="{{ $device->name }}" name="name" class="form-control" id="name"
                                    placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <label for="code_input" class="col-form-label">Code *</label>
                                <input type="name" name="code" class="form-control" id="code_input"
                                    value="{{ $device->code }}" placeholder="Code" required>
                            </div>

                            <div class="form-group">
                                <label for="locationInput">Location</label>
                                <select id="locationInput" data-toggle="select2" name="location_id" class="select2">
                                    @foreach ($locations as $location)
                                        <option {{ $device->id == $location->id ? 'selected' : '' }}
                                            value="{{ $location->id }}">
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group shadow-textarea">
                                <label for="exampleFormControlTextarea6">Note</label>
                                <textarea class="form-control z-depth-1" name="notes" id="exampleFormControlTextarea6"
                                    rows="3" placeholder="Write note Here ...">{{ $device->notes }}</textarea>
                            </div>



                            <center> <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
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
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script>
        $('[data-toggle="select2"]').select2();

    </script>

@endsection
