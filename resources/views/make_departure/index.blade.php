@extends('layouts.vertical', ['title' => 'Datatables'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
        <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center pt-1">
            <div class="col-4">
                <h4 class="page-title">Make Employee Departure</h4>
            </div>
            <div class="col-4">
                <button
                    class="btn btn btn-success" id="departure_submit" onclick="editExtraTime('','')">Make Manually Departure</button>
            </div>
                <div class="page-title-box col-4">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Make Employee Departures</li>
                        </ol>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                        </div>
                    </div>
                    </div>
                </div>
        </div>
         
        </div>
        <div class="row">
            <div class="form-group col-4">
                    <select name="appointment_id" id="sel_appointment" class="form-control select2">
                        <option value="0" selected >Select Attendance Plan</option>
                        @foreach ($work_appointments as $work_appointment)
                            <option {{ app('request')->input('appointment_id') == $work_appointment->id ? 'selected' : '' }}
                             value="{{ $work_appointment->id }}">{{ $work_appointment->name }}</option>
                        @endforeach
                    </select>
            
            
            </div>    
        </div>  

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">locations</h4> --}}
                        <table id="scroll-horizontal-datatable" class="table table-striped nowrap w-100 " >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Job Number</th>
                                    <th>Attendance Plan</th>
                                    <th>Branch Name</th>
                                    {{-- <th>State</th> --}}
                                    <th>Date</th>
                                    <th>Over time</th>
                                    <th>Created By</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $emp)
                                    <tr>
                                        <td>
                                            <div
                                                class="checkbox checkbox-success form-check-inline">
                                                <input type="checkbox"
                                                    id="checkbox-{{ $emp->employee_id }}"
                                                    name="emps"
                                                    value="{{ $emp->employee_id }}"
                                                    >
                                                <label for="checkbox-{{ $emp->employee_id }}"
                                                    class="w-100"></label>
                                            </div>
                                        </td>
                                        <td>{{$emp->employee->name}}</td>
                                        <td>{{$emp->employee->job_number}}</td>
                                        <td>{{$emp->appointment->name}}</td>
                                        <td>{{$emp->branch->name}}</td>
                                        {{-- <td>
                                            @if ($emp->state)
                                                <p class="badge badge-success badge-pill" style="font-size: 12px">Success</p>
                                            @else
                                                <p class="badge badge-danger badge-pill" style="font-size: 12px">Fail</p>
                                            @endif
                                        </td> --}}
                                        <td>{{$emp->date}}</td>
                                        <td>{{$emp->overtime}}</td>
                                        <td>{{$emp->user_name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
   
    </div>

    <div class="modal fade" id="details-modal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Add Over Time</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="details-content">
                <form id="details">
                    @csrf
                    <input type="text" name="over_time" class="form-control 24hours-timepicker" id="details-value">
                    <button type="submit" id="departure" class="mt-1 btn btn-success">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@section('script')
    <!-- Plugins js-->

  <!-- Plugins js-->
  <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script> --}}
  <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
  <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
  <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
 
  
    <script>
        
        $('.24hours-timepicker').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultHour : 0,
        });

    </script>
    <script>
         $('.select2').select2()
        function insertParam(key, value) {
            key = encodeURIComponent(key);
            value = encodeURIComponent(value);

            // kvp looks like ['key1=value1', 'key2=value2', ...]
            var kvp = document.location.search.substr(1).split('&');
            let i=0;

            for(; i<kvp.length; i++){
                if (kvp[i].startsWith(key + '=')) {
                    let pair = kvp[i].split('=');
                    pair[1] = value;
                    kvp[i] = pair.join('=');
                    break;
                }
            }
        
            if(i >= kvp.length){
                kvp[kvp.length] = [key,value].join('=');
            }
        
            // can return this or...
            let params = kvp.join('&');
        
            // reload page with new params
            document.location.search = params;
    }

    $(document).ready(function(){
            
            $('#sel_appointment').change(function(e){
                let appointment_id = $('#sel_appointment').val();
                insertParam('appointment_id',appointment_id)

            });
        });  
 
        const editExtraTime = (details, id) => {
            $('#details-modal').modal('show')
            $('#details-value').val(details)
            $('#assign_appointment_id').val(id)
        }
        $(document).ready(function(){
           
             $('#departure').click(function(e){
               e.preventDefault();
               let employees_departure = []
               let appointment_id = $('#sel_appointment').val();
               let overtime = $("#details-value").val();
               console.log(overtime);
               $("input:checkbox[name=emps]:checked").each(function() {
                employees_departure.push($(this).val());
                 });
                 
                 $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
              $.ajax({
                 url: "{{route('store_employees_departures')}}",
                 method: 'POST',
                 data: {
                    'employees_departure':employees_departure,
                    'appointment_id':appointment_id,
                    'overtime':overtime,
                   '_token' : "{{ csrf_token() }}"
                 
                },
                 success: function(result){
                    notyf.success('تم التحديث بنجاح')
                    window.location.reload();
                    console.log(result);
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
