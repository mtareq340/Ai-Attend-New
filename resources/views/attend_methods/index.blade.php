@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row align-items-center py-2">
            {{-- <div class="col-12"> --}}
            <div class="col-4">
                <h4 class="page-title">Attends Methods</h4>
            </div>
            <div class="col-4">
                @can('add_attend_method')
                    <button class="btn btn btn-primary">
                        <a href="{{ route('attend_methods.create') }}" style="color:white"><i class="fa fa-plus"></i> Add
                            Attend Method</a>
                    </button>
                @endcan
            </div>
            <div class="page-title-box col-4">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attend Methods</li>

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

                        {{-- <h4 class="header-title">Attend Methods</h4> --}}

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Note</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($attend_methods as $attend_method)
                                    <tr>
                                        <td>
                                            <div class="row row-xs wd-xl-4p">
                                                @can('edit_attend_method')
                                                    <a href="{{ route('attend_methods.edit', $attend_method->id) }}"
                                                        class="action-icon">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_attend_method')
                                                    <form action="{{ route('attend_methods.destroy', $attend_method->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="border-color:white; color:red; font-size: 0.8rem;"
                                                            class="action-icon delete" type="submit"> <i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                        <td>{{ $attend_method->name }}</td>
                                        <td>
                                            <input type="checkbox"
                                                onchange="toggleActivationAndLocked(event,'{{ $attend_method->id }}','active')"
                                                class="js-switch" {{ $attend_method->active ? 'checked' : '' }}
                                                data-plugin="switchery" />
                                        </td>
                                        <td>{{ $attend_method->notes }}</td>
                                        
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
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Page js-->
    <script>
        const toggleActivationAndLocked = (e, id, active) => {

            (async () => {
                try {
                    let checked = e.target.checked;
                    const rawResponse = await fetch("{{ route('active_attendance_method') }}", {
                        method: 'PATCH',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            checked,
                            active
                        })
                    });
                    const content = await rawResponse.json();

                    if (content.error) {
                        // notify error
                        alert("something went wrong")
                    }
                } catch (err) {
                    console.log(err);
                }
            })
            ();

        }

    </script>


@endsection
