@extends('layouts.vertical', ['title' => 'Datatables'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center my-2">
            {{-- <div class="col-12"> --}}
            <div class="col-4">
                <h4 class="page-title">Appointments</h4>
            </div>
            <div class="col-4">
                @can('add_appointment')
                    <a href="{{ route('appointment.create') }}" class="btn btn btn-primary waves-effect waves-light"><i
                            class="fa fa-plus"></i> Add Appointment</a>
                @endcan
            </div>
            <div class="page-title-box col-4">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div>
            </div>
            {{-- </div> --}}
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">Appointments</h4> --}}
                        <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location Name</th>
                                    <th>Branch Name</th>
                                    <th>Start from (P1)</th>
                                    <th>End to (P1)</th>
                                    <th>Daley Time (P1)</th>
                                    <th>Overtime Time (P1)</th>
                                    <th>Start from (P2)</th>
                                    <th>End to (P2)</th>
                                    <th>Start from (P2)</th>
                                    <th>End to (P2)</th>
                                    <th>Daley Time (P2)</th>
                                    <th>Overtime Time (P2)</th>
                                    <th>Date</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                    <th> Active Extra time </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($appointments as $appoint)
                                    <tr>
                                        <td>{{ $appoint->name }}</td>
                                        <td>{{ $appoint->location->name }}</td>
                                        <td>{{ $appoint->branch->name }}</td>
                                        <td>{{ $appoint->start_from_period_1 }}</td>
                                        <td>{{ $appoint->end_to_period_1 }}</td>
                                        <td>{{ $appoint->delay_period_1 }}</td>
                                        <td>{{ $appoint->overtime_period_1 }}</td>
                                        <td>{{ $appoint->start_from_period_2 }}</td>
                                        <td>{{ $appoint->end_to_period_2 }}</td>
                                        <td>{{ $appoint->delay_period_2 }}</td>
                                        <td>{{ $appoint->overtime_period_2 }}</td>
                                        <td>{{ $appoint->date }}</td>
                                        <td>{{ $appoint->created_at }}</td>
                                        <td>{{ $appoint->updated_at }}</td>
                                        <td>
                                            <div class="row row-xs wd-xl-4p">
                                                @can('edit_appointment')
                                                    <a href="{{ route('appointment.edit', $appoint->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                @endcan
                                                {{-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> --}}
                                                @can('delete_appointment')
                                                    <form action="{{ route('appointment.destroy', $appoint->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="border-color:white; color:red; font-size: 0.8rem;"
                                                            class="action-icon delete" type="submit"> <i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="js-switch" data-plugin="switchery" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>


@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <!-- Page js-->
    <script>
        const toggleActivationextratime = (e, id, type) => {

            (async () => {
                try {
                    let checked = e.target.checked;
                    const rawResponse = await fetch('{{ route('active_device') }}', {
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
                    console.log(content);

                    if (content.error) {
                        // notify error
                    } else {
                        // notify success

                    }
                } catch (err) {
                    console.log(err);
                }
            })
            ();

        }

    </script>

@endsection
