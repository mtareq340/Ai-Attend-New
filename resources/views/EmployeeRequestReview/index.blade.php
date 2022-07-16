@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Employees requests</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <ul class="nav nav-tabs mb-2">
            <div class="nav-item">
                <a href="/dashboard/employee_request_review" aria-expanded="true"
                    class="nav-link {{ !app('request')->input('status') ? 'active' : '' }}">
                    All
                </a>
            </div>
            <li class="nav-item">
                <a href="/dashboard/employee_request_review?status=1" aria-expanded="true"
                    class="nav-link {{ app('request')->input('status') == 1 ? 'active' : '' }}">
                    Pending
                </a>
            </li>
            <li class="nav-item">
                <a href="/dashboard/employee_request_review?status=2" aria-expanded="true"
                    class="nav-link {{ app('request')->input('status') == 2 ? 'active' : '' }}">
                    approved
                </a>
            </li>
            <li class=" nav-item">
                <a href="/dashboard/employee_request_review?status=3" aria-expanded="true"
                    class="nav-link {{ app('request')->input('status') == 3 ? 'active' : '' }}">
                    rejected
                </a>
            </li>
        </ul>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">



                        {{-- <h4 class="header-title">Employees Request</h4> --}}
                        <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive nowrap w-100">

                            <div class="dt-buttons"></div>
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Title</th>
                                    <th>Attachment</th>
                                    <th>Date</th>
                                    <th>status</th>
                                    <th>details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($requestreviews as $request)
                                    <tr>
                                        <td>{{ $request->employee->name }}</td>
                                        <td>{{ $request->request }}</td>

                                        <td>
                                            @if ($request->attachment)
                                                {{-- {{ $request->attachment }} --}}
                                                <a target="_blank" href="{{ $request->attachment }}">
                                                    <i class="fa fa-link"></i>
                                                    <span>attachment</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $request->date }}</td>
                                        <td>
                                            @switch($request->status)
                                                @case(1)
                                                    <span class="badge badge-warning">pending</span>
                                                @break
                                                @case(3)
                                                    <span class="badge badge-danger">rejected</span>
                                                @break
                                                @case(2)
                                                    <span class="badge badge-success">approved</span>
                                                @break
                                                @default

                                            @endswitch
                                        </td>
                                        <td>
                                            <button onclick="showDetails('{{ $request->details }}')"
                                                class="btn btn-sm btn-info">show details</button>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($request->status != 2)

                                                    <form action="{{ route('accept_response', $request->id) }}"
                                                        class="mr-1" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success">Approve</button>
                                                    </form>
                                                @endif

                                                @if ($request->status != 3)

                                                    <form action="{{ route('reject_response', $request->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger">
                                                            Reject
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->


    <div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Request details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="details-content">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
<!-- Plugins js-->

<script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<!-- Page js-->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    // // toggle active with ajax
    // const toggleActivationAccept = (e, id, type) => {
    //     (async () => {
    //         try {
    //             let checked = e.target.checked;
    //             const rawResponse = await fetch('{{ route('toggleActiveReqEmp') }}', {
    //                 method: 'PATCH',
    //                 headers: {
    //                     'Accept': 'application/json',
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                 },
    //                 body: JSON.stringify({
    //                     id,
    //                     checked,
    //                     type
    //                 })
    //             });
    //             const content = await rawResponse.json();
    //             console.log(content);

    //             if (content.error) {
    //                 // notify error
    //             } else {
    //                 // notify success
    //             }
    //         } catch (err) {
    //             console.log(err);
    //         }
    //     })
    //     ();

    // }


    const showDetails = (details) => {
        $('#details-modal').modal('show')
        $('#details-content').text(details)
    }

</script>
@endsection
