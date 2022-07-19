@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row align-items-center">
            <div class="col-3">
                <h4 class="page-title">Employees</h4>
            </div>
            <div class="col-5">
                <div class="row">
                    @can('add_employee')

                        <button type="button" class="btn  btn-primary waves-effect waves-light " data-toggle="modal"
                            data-target="#con-close-modal"><i class="fa fa-plus"></i> Add Employee</button>

                        <a href="{{ route('employees.excelPage') }}" class="btn waves-effect waves-light ml-1 btn-success"><i
                                class="fa fa-plus"></i> Upload Excel
                            Sheet</a>

                        <a href="{{ route('downloadExcelEmps') }}" class="btn waves-effect waves-light ml-1 btn-dark"><i
                                class="fa fa-plus"></i> Download
                            excel file</a>
                    @endcan

                </div>
            </div>
            <div class="page-title-box col-4">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- <h4 class="header-title">Employees table</h4> --}}
                        <table id="scroll-horizontal-datatable" class="table table-striped nowrap w-100">
                            <div class="dt-buttons"></div>
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Job number</th>
                                    <th>Branch</th>
                                    <th>Attendance Plan</th>
                                    <th>Attend methods</th>
                                    <th>Active</th>
                                    <th>Locked</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $emp)
                                    <tr>
                                        <td>
                                            <div class="row row-xs wd-xl-4p">
                                                @can('edit_employee')
                                                    <a href="{{ route('employees.edit', $emp->id) }}" class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                @endcan
                                                <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                                @can('delete_employee')
                                                    <form action="{{ route('employees.destroy', $emp->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="border-color:white; color:red; font-size: 0.8rem;"
                                                            class="action-icon delete" type="submit"> <i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>

                                        <td>{{ $emp->name }}</td>
                                        <td>{{ $emp->job->name }}</td>
                                        <td>{{ $emp->job_number }}</td>
                                        <td>{{ $emp->branch->name }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($emp->appointments as $appointment)
                                                    <li>{{ $appointment->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($emp->attend_methods as $method)
                                                    <li>
                                                        {{ $method->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            {{-- <a href="/dashboard/edit_employee_attend_method/{{ $emp->id }}"
                                                type="button" class="btn btn-sm btn-primary float-right">
                                                <i class="mdi mdi-square-edit-outline"></i>

                                            </a> --}}
                                            <button
                                                onclick="onClickEditAttendMethods('{{ json_encode($emp->attend_methods) }}' , '{{ $emp->id }}')"
                                                class="btn btn-xs btn-primary float-right"><i
                                                    class="mdi mdi-square-edit-outline"></i></button>
                                        </td>
                                        <td>
                                            @can('edit_employee')
                                                <input type="checkbox"
                                                    onchange="toggleActivationAndLocked(event,'{{ $emp->id }}' , 'active')"
                                                    class="js-switch" {{ $emp->active ? 'checked' : '' }}
                                                    data-plugin="switchery" />
                                            @endcan
                                        </td>
                                        <td>
                                            @can('edit_employee')
                                                <input type="checkbox"
                                                    onchange="toggleActivationAndLocked(event,'{{ $emp->id }}' , 'locked')"
                                                    class="js-switch-red" {{ $emp->locked ? 'checked' : '' }}
                                                    data-plugin="switchery" />
                                            @endcan
                                        </td>

                                        <td>{{ $emp->email }}</td>
                                        <td>{{ $emp->phone }}</td>
                                        <td>{{ $emp->address }}</td>



                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->




        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Employees</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{ route('employees.store') }}" method="post" autocomplete="off"
                        class="needs-validation">
                        @csrf
                        <div class="modal-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name *</label>
                                        <input type="text" name="name" class="form-control" id="field-1"
                                            placeholder="Jone Doe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="field-2"
                                            placeholder="Ex@ex.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputJob" class="col-form-label">Job *</label>
                                        <select name="job_id" id="inputJob" class="form-control selectize-drop-header"
                                            placeholder="Select a job..." required>
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->id }}">{{ $job->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputJob" class="col-form-label">Job Number *</label>
                                        <input type="number" name="job_number" class="form-control" id="job_num"
                                            placeholder="Select Job Number">
                                    </div>
                                </div>


                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Phone num 1 *</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="phone num 1" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Phone num 2 </label>
                                        <input type="text" name="phone_num2" class="form-control" id="phone_num2"
                                            placeholder="phone num 2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Address <span
                                                class="text-muted font-weight-light">(optional)</span></label>
                                        <input type="text" name="address" class="form-control" id="inputAddress"
                                            placeholder="1234 Main St">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Gender </label>
                                    <div class="d-flex">
                                        <div class="radio mr-1">
                                            <input type="radio" name="gender" id="genderM" value="male" required="" checked>
                                            <label for="genderM" class="pl-1 m-0">
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="gender" id="genderF" value="female">
                                            <label for="genderF" class="pl-1">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputBranch" class="col-form-label">Branch *</label>
                                        <select name="branch_id" id="inputBranch" class="form-control selectize-drop-header"
                                            placeholder="Select a branch..." required>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="input-age" class="col-form-label">Age <span
                                                class="text-muted font-weight-light">(optional)</span></label>
                                        <input type="number" name="age" class="form-control" id="input-age"
                                            placeholder="age">
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Add Employees</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->

        {{-- //////////////////////////////////////////////////////////////// --}}
        {{-- edit moal --}}
        {{-- //////////////////////////////////////////////////////////////// --}}

        {{-- <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employees</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form autocomplete="off" class="needs-validation">
                        @csrf
                        <div class="modal-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name</label>
                                        <input type="text" name="name" value="" class="form-control" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" name="email" value="" class="form-control" id="email"
                                            placeholder="Ex@ex.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Phone num 1 *</label>
                                        <input type="text" name="phone" value="" class="form-control" id="phone"
                                            placeholder="010..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">Phone num 2 </label>
                                        <input type="text" name="phone_num2" value="" class="form-control" id="phone_num2"
                                            placeholder="phone num 2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-form-label">Address <span
                                                class="text-muted font-weight-light">(optional)</span></label>
                                        <input type="text" name="address" value="" class="form-control" id="address"
                                            placeholder="1234 Main St">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gender *</label>
                                        <div class="d-flex">
                                            <div class="radio mx-1">
                                                <input type="radio" name="gender" id="male" value="" required="" checked>
                                                <label for="genderM">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="radio mx-1">
                                                <input type="radio" name="gender" id="female" value="">
                                                <label for="genderF">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputBranch" class="col-form-label">Branch *</label>
                                        <select name="branch_id" id="branch" class="selectize-drop-header" required>
                                            @foreach ($branches as $branch)
                                                <option {{ $emp->branch_id == $branch->id ? 'selected' : '' }}
                                                    value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputJob" class="col-form-label">Job *</label>
                                        <select name="job_id" id="inputJob" class="selectize-drop-header"
                                            placeholder="Select a job..." required>
                                            @foreach ($jobs as $job)
                                                <option {{ $emp->branch_id == $branch->id ? 'selected' : '' }}
                                                    value="{{ $job->id }}">{{ $job->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="input-age" class="col-form-label">Age <span
                                                class="text-muted font-weight-light">(optional)</span></label>
                                        <input type="number" name="age" value="" class="form-control" id="age"
                                            placeholder="age">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal --> --}}




    </div> <!-- container -->



    {{-- attend method modal --}}
    <div id="attendMethods-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="attendMethods-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="attendMethods-modalLabel">Attend Methods</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <ul id="selected_atten_methods"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>

    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        const toggleActivationAndLocked = async (e, id, type) => {
            try {
                let checked = e.target.checked;
                const rawResponse = await fetch('{{ route('toggleActiveEmp') }}', {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id,
                        checked,
                        type
                    })
                });
                const content = await rawResponse.json();

                if (content.error) {
                    // notify error
                } else {
                    // notify success

                }
            } catch (err) {
                console.log(err);
            }


        }


        function activevication() {
            let isChecked = $('#qr')[0].checked
            // console.log(isChecked);
            return isChecked;
        }

        function activebar() {
            let isChecked = $('#bar')[0].checked
            // console.log(isChecked);
            return isChecked;
        }

        $(document).ready(function() {
            // ////////////////////////////
            $('body').on('click', '#updatesubmit', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                console.log(id)
                $.get('employees/' + id + '/edit', function(data) {
                    //  $('#userCrudModal').html("Edit category");
                    $('#submit').val("Edit category");
                    $('#updateModalLong').modal('show');
                    $('#id').val(data.data.id);
                    $('#name').val(data.data.name_en);
                    $('#jobnum').val(data.data.jobNum);
                    $("#email").val(data.data.email);
                    $("#pass").val(data.data.password);
                    $("#tel1").val(data.data.tel_1);
                    $("#dob").val(data.data.Dob);
                    $("#address").val(data.data.address);
                })
            });

            $('body').on('click', '#submit', function(event) {
                const notyf = new Notyf();
                event.preventDefault()
                var id = $("#id").val();
                var name_en = $("#name").val();
                var email = $("#email").val();
                var password = $("#pass").val();
                var jobNum = $("#jobnum").val();
                var tel_1 = $("#tel1").val();
                var address = $("#address").val();
                var Dob = $("#dob").val();
                var Branch = $("#brach").val();
                var deaprtment = $("#department").val();

                console.log(deaprtment);
                $.ajax({
                    url: 'employee/edit/' + id,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "POST",
                    data: {
                        id: id,
                        name_en: name_en,
                        email: email,
                        password: password,
                        jobNum: jobNum,
                        tel_1: tel_1,
                        Dob: Dob,
                        address: address,
                        Branch: Branch,
                        deaprtment: deaprtment,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        let msg = data.msg;
                        notyf.success(msg);
                        //   $('.update-form').trigger("reset");
                        //   $('#updateModalLong').modal('hide');
                        //   window.location.reload(true);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

        });



        const all_methods = JSON.parse('@json($attend_methods)')
        const onClickEditAttendMethods = (attend_methods, emp_id) => {
            const list = $('#selected_atten_methods')
            $('#attendMethods-modal').modal('show')
            list.empty()

            $.ajax({
                    url: '{{route('getEmpAttendMethod')}}',
                    type: "get",
                    data: {
                        emp_id
                    },
                    success: function(data) {
                    // getEmpAttendMethod
                    all_methods.forEach(method => {
                        const found = data.some(_m => _m.name == method.name)
                        console.log(found);
                        if (found) method['selected'] = true
                        else method['selected'] = false
                    });

                    all_methods.forEach(method => {
                        list.append(`
                            <li class="row">
                                <div class="custom-control custom-checkbox">
                                        <input  ${method.selected ? 'checked' : ''} onchange="update_attend_method(${method.id} , ${emp_id} , ${! method.selected})" type="checkbox" class="custom-control-input" id="${method.id}">
                                        <label class="custom-control-label" for="${method.id}">${method.name}</label>
                                </div>
                            </li>
                        `)
                    });

                    },
                    error: function(error) {
                        notyf.error('حدث خطا ما حاول لاحقا')
                        console.log(error);
                    }
                });

        }

        const update_attend_method = (method_id, emp_id , state) => {
            $.ajax({
                    url: '{{route('toggleAttendMethod')}}',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "patch",
                    data: {
                        method_id,
                        emp_id
                    },
                    success: function(data) {
                        notyf.success('تم التعديل بنجاح')
                    },
                    error: function(error) {
                        notyf.error('حدث خطا ما حاول لاحقا')
                    }
                });
        }

    </script>
@endsection
