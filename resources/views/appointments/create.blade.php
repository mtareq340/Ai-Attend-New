@extends('layouts.vertical', ['title' => 'Form Wizard'])

@section('content')
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
                            <li class="breadcrumb-item active">Wizard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Form Wizard</h4>
                </div>
            </div>
        </div>     
        <!-- end page title -->
  


        <div class="row">
           
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mb-3"> Wizard With Form Validation</h4>

                        <div id="rootwizard">
                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                <li class="nav-item" data-target-form="#accountForm">
                                    <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-account-circle mr-1"></i>
                                        <span class="d-none d-sm-inline">Appointment</span>
                                    </a>
                                </li>
                                <li class="nav-item" data-target-form="#profileForm">
                                    <a href="#second" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-face-profile mr-1"></i>
                                        <span class="d-none d-sm-inline">Location & Devices</span>
                                    </a>
                                </li>
                                <li class="nav-item" data-target-form="#otherForm">
                                    <a href="#third" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                        <span class="d-none d-sm-inline">Employees</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mb-0 b-0 pt-0">

                                <div class="tab-pane" id="first">
                                    <form id="accountForm" method="post" action="#" class="form-horizontal">
                                        <div class="row">
                                            <div class="col-12">
                                               
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="userName3">Periods</label>
                                                    <div class="col-md-9">
                                                        <div class="form-group mb-3">
                                                           
                                                            <div class="radio form-check-inline">
                                                                <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                                                <label for="inlineRadio1"> One </label>
                                                            </div>
                                                            <div class="radio form-check-inline">
                                                                <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                                                <label for="inlineRadio2"> Two </label>
                                                            </div>
                                                          
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="userName3">the first period</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-town-city">Start Time</label>
                                                                    <input type="time" id="preloading-timepicker" class="form-control" placeholder="Pick a time">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-state"> End Time</label>
                                                                    <input class="form-control" type="time" placeholder="Enter your End Time" id="billing-state" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="billing-zip-postal">Delay Period</label>
                                                                    <input class="form-control" type="time" placeholder="Enter your Delay Period" id="billing-zip-postal" />
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="password3"> Attendance Days</label>
                                                    <div class="col-md-9">
                                                   
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="" value="option1" >
                                                            <label for="inlineCheckbox2"> Saturday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="" value="option1" >
                                                            <label for="inlineCheckbox2"> Sunday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" >
                                                            <label for="inlineCheckbox2"> Monday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" >
                                                            <label for="inlineCheckbox2"> Tuesday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                                            <label for="inlineCheckbox2"> Wednesday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                                            <label for="inlineCheckbox2"> Thursday </label>
                                                        </div>
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                                            <label for="inlineCheckbox2"> Friday </label>
                                                        </div>
                                                 
                                                        
                                                 
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-3 col-form-label" for="confirm3">repeat</label>
                                                    <div class="col-md-9">
                                                        <div class="checkbox checkbox-success form-check-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                                            <label for="inlineCheckbox2"> repeat </label>
                                                        </div>                                                  
                                                  </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="second">
                                    <form id="profileForm" method="post" action="#" class="form-horizontal">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="inputBranch" class="col-form-label">Location *</label>
                                                <select name="location_id" id="inputBranch" class="selectize-drop-header" placeholder="Select a location..." required>
                                                    @foreach ($locations as $location)
                                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="third">
                                         <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                   
                                                    <table id="demo-custom-toolbar"  data-toggle="table"
                                                            data-search="true"
                                                            data-sort-name="id"
                                                            data-page-size="1000"
                                                            >
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th></th>
                                                            <th data-field="id" data-sortable="true" data-formatter="invoiceFormatter"> Employee ID</th>
                                                            <th data-field="name" data-sortable="true">Name</th>
                                                        
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" name="emp_ids"></td>
                                                            <td>UB-1609</td>
                                                            <td>Boudreaux</td>
                                                        
                                                        </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end card-box-->
                                            </div> <!-- end col-->
                                        </div>
                                </div>

                                <ul class="list-inline wizard mb-0">
                                    <li class="previous list-inline-item"><a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                    </li>
                                    <li class="next list-inline-item float-right"><a href="javascript: void(0);" class="btn btn-secondary">Next</a></li>
                                </ul>

                            </div> <!-- tab-content -->
                        </div> <!-- end #rootwizard-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div> 
        <!-- end row -->
        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-wizard.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/jquery.todo.js')}}"></script>
       <!-- Plugins js-->
       <script src="{{asset('assets/libs/bootstrap-table/bootstrap-table.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/bootstrap-tables.init.js')}}"></script>
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