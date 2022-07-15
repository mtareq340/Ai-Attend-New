@extends('layouts.vertical', ['title' => 'Datatables'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center pt-1">
            <div class="col-4">
                <h4 class="page-title">Employee Attendance</h4>
            </div>
            <div class="col-4">
                    <button id="attendance_submit" class="btn btn-success" >Make Succesful Attendance</button>
            </div>
                <div class="page-title-box col-4">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee Attendance</li>
                        </ol>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                        </div>
                    </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                    <select name="appointment_id" id="sel_appointment" class="form-control">
                        <option value="" selected disabled>Select Attendance Plan</option>
                        @foreach ($work_appointments as $work_appointment)
                            <option value="{{ $work_appointment->id }}">{{ $work_appointment->name }}</option>
                        @endforeach
                    </select>
            
            
            </div>
            </div>  

    
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">locations</h4> --}}
                        <table id="datatable-buttons" class="table table-striped nowrap w-100 " >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Job Number</th>
                                    <th>Appointment Name</th>
                                    <th>Branch Name</th>
                                    <th>Attendance Method</th>
                                    <th>State</th>
                                    <th>Created At</th>
                                    <th>Departure time</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $emp)
                                    <tr>
                                        <td>
                                            @if ($emp->state == 0)
                                            <div
                                                class="checkbox checkbox-success form-check-inline">
                                                <input type="checkbox"
                                                    id="checkbox-{{ $emp->id }}"
                                                    name="emps"
                                                    value="{{ $emp->id }}"
                                                    >
                                                <label for="checkbox-{{ $emp->id }}"
                                                    class="w-100"></label>
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{$emp->employee->name}}</td>
                                        <td>{{$emp->employee->job_number}}</td>
                                        <td>{{$emp->appointment->name}}</td>
                                        <td>{{$emp->branch->name}}</td>
                                        <td>{{$emp->attendanc_method->name}}</td>
                                        <td>
                                            @if ($emp->state)
                                                <p class="badge badge-success badge-pill" style="font-size: 12px">Success</p>
                                            @else
                                                <p class="badge badge-danger badge-pill" style="font-size: 12px">Fail</p>
                                            @endif
                                            {{-- {{$emp->state}} --}}
                                        </td>
                                        <td>{{$emp->created_at}}</td>
                                        <td>{{$emp->departure_time}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
   
    </div>



@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
      $(document).ready(function(){

        $('#sel_appointment').change(function(e){
            let appoitment_id = $('#sel_appointment').val();
            window.location = `/dashboard/employee_attendance?appointment_id=${appoitment_id}`;
            
        });
      });  
    </script>
    <script>
        $(document).ready(function(){
           

             $('#attendance_submit').click(function(e){
               e.preventDefault();
               let employees_attendance = []

               $("input:checkbox[name=emps]:checked").each(function() {
                employees_attendance.push($(this).val());
                 });
                 $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
              $.ajax({
                 url: "{{ route('make_employees_attendance_success') }}",
                 method: 'post',
                 data: {
                   employees_attendance,
                   '_token' : "{{ csrf_token() }}"
                 
                },
                 success: function(result){
                    notyf.success('تم التحديث بنجاح')
                    window.location.reload();

                },
                 error:function(err)
                 {
                    notyf.error('حدثت مشكله برجاء المحاوله مره اخري')
                    console.log(err);
                 }
                 
                });
              });
        });
    </script>
@endsection
