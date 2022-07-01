@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/clockpicker/clockpicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/clockpicker/clockpicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    
    <style>
        .selectize-dropdown-header{
            display : none !important
        }
    </style>
@endsection
@section('textArea')
<style>
    .shadow-textarea textarea.form-control::placeholder {
        font-weight: 300;
    }
    .shadow-textarea textarea.form-control {
        padding-left: 0.8rem;
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
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('appointment.index')}}">Appointments</a></li>
                            <li class="breadcrumb-item active">Edit Appointment</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Appointment</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Appointments</h4>
                      
                        <form action="{{ route('appointment.update',$appointment->id)}}" method="post"  class="needs-validation" novalidate>
                            @csrf
							{{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="name"></label>
                                    <input type="text" class="form-control" name="name" value="{{$appointment->name}}" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label for="inputLocation" class="col-form-label">location *</label>
                                <select  name="location_id" id="inputlocation" class="selectize-drop-header" placeholder="Select a location..." required>
                                    <option selected value="{{$appointment->location_id}}">{{$appointment->location->name}}</option>
                                    @foreach ($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputBranch" class="col-form-label">Branch *</label>
                                <input type="text" class="form-control bg-light" value="{{$branch->name}}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label>Start From</label>
                                <div class="input-group ">
                                    <input type="datetime-local" value="{{$appointment->start_from}}" class="form-control" name ="start_from" required >
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>End To</label>
                                <div class="input-group ">
                                    <input type="datetime-local"  class="form-control" name ="end_to" value="{{$appointment->end_to}}" required>
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-md-12">
                                    <label>Delay hours & minutes</label>
                                    <input type="text"  name="delay" class="form-control flatpickr-input active 24hours-timepicker" value="{{$appointment->delay}}" required readonly="readonly">
                                </div>
                                </div>
                               <div class="row">
                                <div class="form-group mb-3 col-md-12">
                                    <label>overtime hours & minutes</label>
                                    <input type="text"  name="overtime" class="form-control flatpickr-input active 24hours-timepicker" value="{{$appointment->overtime}}" required readonly="readonly">
                                </div>
                               </div>
                           
                           <div class="form-group mb-3">
                            <label>Date Picker</label>
                            <input type="date" class="form-control" value="{{$appointment->date}}" required name ="date">
                        </div>
                            <center><button type="submit" class="btn btn-success waves-effect waves-light">Update</button></center>

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
     <!-- Plugins js-->
     <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
     <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
     <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
     <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
     <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
     <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
     <script src="{{asset('assets/libs/devbridge-autocomplete/devbridge-autocomplete.min.js')}}"></script>
     <script src="{{asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js')}}"></script>
     <script src="{{asset('assets/libs/clockpicker/clockpicker.min.js')}}"></script>
     <!-- Plugins js-->
     <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
     <script src="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
     <script src="{{asset('assets/libs/clockpicker/clockpicker.min.js')}}"></script>
     <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
 
     <!-- Page js-->
     <script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
     <!-- Page js-->
     <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
     <script>
         $('.24hours-timepicker').flatpickr({
             enableTime: true,
             noCalendar: true,
             dateFormat: "H:i",
             time_24hr: true,
         });
     </script>
     <script src="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
     <script>
 
         var defaultOptions = {
                 };
         
                 // touchspin
                 $('[data-toggle="touchspin"]').each(function (idx, obj) {
                     var objOptions = $.extend({}, defaultOptions, $(obj).data());
                     $(obj).TouchSpin(objOptions);
                 });
         </script>
         <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    @endsection