@extends('layouts.vertical', ['title' => 'Form Components'])
@section('css')
<link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{route('employee_attendance.index')}}">Employees Attendance</a></li>
                            <li class="breadcrumb-item active">Add Employees Attendance</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Employee Attendance</h4>
                
                </div>
            </div>
        </div>     
        <!-- end page title --> 




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('employee_attendance.store')}}" method="post" class="needs-validation" novalidate>
                            @csrf
                          
                            <div class="form-group" id="employee">
                                <label for="location">Employees *</label>
                                <select name="employee_id[]" id="select2-multiple" class="selectemp form-control select2-multiple select2-hidden-accessible" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." data-select2-id="4" tabindex="-1" aria-hidden="true">    
                                    @foreach ($employees as $emp )
                                    <option value="{{$emp->id}}" >{{$emp->name}}</option>                                    
                                    @endforeach                                     
                                    </select>
                                </div>
                            <div class="form-group">
                                <label for="attend">Attendance Methods *</label>
                                <select id="atten"  name="attendance_method_id" class="form-control " data-toggle="select2" >
                                    <option selected disabled value="" >Select Attendance</option>
                                    @foreach ( $attendance as $a )
                                    <option value="{{$a->id}}" >{{$a->name}}</option>
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
    <script>
        function getemployess(){
            let branch_id = $('#branch').val();
            let job_id = $('#inputjob').val();
            // console.log(branch_id);
            // console.log(job_id);
            $.ajax(
                {
                    "type":"get",
                    'url':`{{ route('getEmpsByBranch') }}`,
                    'data':{branch_id : branch_id , job_id:job_id},
                    "success":function(data){
                        console.log(data);
                        $('#employee').css("display","block");
                        $('.selectemp').html(data);
                    },
                    "error":function(){
                        
                    },

                });
        }
    </script>
    <script>
            function getappointments(){
                 let branch_id = $('#branch').val();
                 let location_id = $('#location_id').val();
                //  console.log(branch_id);
                //  console.log(job_id);
                 $.ajax(
                     {
                         "type":"get",
                         'url':`{{ route('getappointment') }}`,
                         'data':{location_id : location_id , branch_id:branch_id},
                         "success":function(data){
                             console.log(data);
                             $('#appointment').css("display","block");
                             $('#appoint').html(data);
                         },
                         "error":function(){

                         },
                     
                     });
        }

    </script>
@endsection