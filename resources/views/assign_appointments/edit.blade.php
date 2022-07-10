@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
<link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('assign_appointment.index')}}">Assign Appointment</a></li>
                            <li class="breadcrumb-item active">Edit Assign Appointment</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Assign Appointment</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Assign Appointment</h4>
                      
                        <form action="{{route('assign_appointment.update',$assign->id)}}" method="post" class="needs-validation" novalidate>
                            @csrf
							{{ method_field('PATCH') }}
                            <div class="form-group">
                                {{-- <input type="text" value="{{$assign->id}}" name="" id=""> --}}
                                <label for="location">Employees *</label>
                                <select name="employee_id" class="form-control" data-toggle="select2" disabled  aria-hidden="true">
                                    <option value="{{$assign->employees->id}}" disabled >{{$assign->employees->name}}</option>
                                      @foreach ($employees as $a)
                                        <option value="{{$a->id}}">{{$a->name}}</option>
                                    @endforeach                              
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Appointments *</label>
                                <select name="work_appointment_id"  class="form-control" data-toggle="select2"  aria-hidden="true">
                                    <option selected disabled value="" >Select Appointment</option>
                                    @foreach ($appointments as $a)
                                        <option value="{{$a->id}}">{{$a->name}}</option>
                                    @endforeach                              

                                </select>
                            </div>

                            <center> <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button> </center>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


        
    </div> <!-- container -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
      $("#select2-multiple").select2({
        closeOnSelect: false
      });
    });
    </script>
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js')}}"></script>
    
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
   
@endsection