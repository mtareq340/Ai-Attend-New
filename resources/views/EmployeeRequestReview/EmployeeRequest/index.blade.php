@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />    
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Employees</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

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
                                    <th>Request</th>
                                    <th>Request Type</th>
                                    <th>User Name</th>
                                    <th>Date</th>
                                   
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach($employee_requests as $emp)
                                <tr>
                                    <td>{{ $emp->employee->name }}</td>
                                    <td>{{ $emp->request }}</td>
                                    @if ($emp->request_type->name=='reject')
                                        <td>
                                            <p class="badge badge-danger badge-pill" style="font-size: 13px">
                                            {{ $emp->request_type->name }}</p>
                                        </td>
                                    @else
                                        <td >
                                            <p class="badge badge-success badge-pill" style="font-size: 13px">{{ $emp->request_type->name }}</p>    
                                        </td>
                                    @endif
                                    <td>{{ $emp->user->name}}</td>
                                    <td>{{ $emp->date }}</td>
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
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>

    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script>
        var elem = document.querySelectorAll('.js-switch');
        elem.forEach(element => {
            new Switchery(element , {
                size : 'small',
                color : '#64b0f2'
            });
        });

        // toggle active with ajax
        const toggleActivationAccept = (e, id , type) => {
        
            (async () => {
                    try {
                        let checked = e.target.checked;
                        const rawResponse = await fetch('{{ route('toggleActiveReqEmp') }}', {
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