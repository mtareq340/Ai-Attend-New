@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row align-items-center my-2">
            {{-- <div class="col-12"> --}}
                <div class="col-4">
                    <h4 class="page-title">Devices</h4>
                </div>
                <div class="col-4">
                    @can('add_device')
                    <button class="btn btn btn-primary">
                        <a href="{{ route('devices.create')}}" style="color:white"><i class="fa fa-plus"></i> Add Device</a>
                    </button>
                    @endcan

                </div>
                <div class="page-title-box col-4">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Devices</li>
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

                        {{-- <h4 class="header-title">Devices</h4> --}}

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Note</th>
                                    <th>Activate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($devices as $device)
                                    <tr>
                                        <td>{{ $device->name }}</td>
                                        <td>{{ $device->code }}</td>
                                        <td>{{ $device->notes }}</td>
                                        <td>
                                            <input type="checkbox"
                                                onchange="toggleActivationAndLocked(event,'{{ $device->id }}' , 'active')"
                                                class="js-switch" {{ $device->active ? 'checked' : '' }}
                                                data-plugin="switchery" />
                                        </td>
                                        <td>
                                            <div class="row row-xs wd-xl-4p">
                                                @can('edit_device')
                                                    <a href="{{ route('devices.edit', $device->id) }}" class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                @endcan
                                                <!-- <button type="button" class="btn btn-warning btn-xs waves-effect waves-light">Btn Xs</button> -->
                                                @can('delete_device')
                                                    <form action="{{ route('devices.destroy', $device->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="border-color:white; color:red; font-size: 0.8rem;"
                                                            class="action-icon delete" type="submit"> <i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endcan
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
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <!-- Page js-->
    <script>

        const toggleActivationAndLocked = (e, id, type) => {

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
