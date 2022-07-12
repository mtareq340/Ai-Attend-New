@extends('layouts.vertical', ['title' => 'Dashboard'])

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">


        <div class="py-2">
            @if (Session::has('alerts'))
                @foreach (json_decode(Session::get('alerts')) as $alert)
                    <div class="mb-1 alert alert-{{ $alert->type }}">{{ $alert->message_en }}</div>
                @endforeach
            @endif
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-user font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{ $plan->count_employees }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Max Employees</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fas fa-user-tie font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $employess_count }}</span>
                                </h3>
                                <p class="text-muted mb-1 text-truncate">Employees</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fas fa-building font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $branches_count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Branches</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="icon-briefcase font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $jobs_count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Jobs</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        <div class="w-100">
            <center>
                <div>
                    <div class="card-box">
                        <div class="dropdown float-right">

                        </div>

                        <p class=" h3 mb-0">Registeration Number : {{ $registeration_number }}</p>

                        <div class="widget-chart text-center" dir="ltr">

                            <div id="chart">
                            </div>
                            <p class="h3 {{ $diffDays <= 5 ? 'text-danger' : 'text-info' }} ">{{ $diffDays }} days
                                left
                            </p>
                            {{-- <div id="total-revenue" class="mt-0"  data-colors="#f1556c"></div> --}}

                            <h5 class="text-muted mt-0">Maximum Employees</h5>
                            <h2>{{ $plan->count_employees }}</h2>


                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </center>

        </div>

        <!-- end row -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title mb-3">Latest 10 Employees Requests Review</h4>

                    <div class="table-responsive" style="height: 330px;overflow: auto;">
                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                            <thead class="thead-light">
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Phone</th>
                                    <th>Request</th>
                                    <th>Date</th>
                                    <th>Accept</th>
                                    <th>Reject</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($empRequestsRevs) > 0)
                                    @foreach ($empRequestsRevs as $empRequestsRev)
                                        <tr>
                                            <td>{{ optional($empRequestsRev->employee)->name }}</td>
                                            <td>{{ optional($empRequestsRev->employee)->phone }}</td>
                                            <td>{{ $empRequestsRev->request }}</td>
                                            <td>{{ $empRequestsRev->date }}</td>
                                            <td>
                                                <form action="{{route('accept_response',$empRequestsRev->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success"><i class="fe-check-circle "></i></button>
                                                </form>
                                          
                                            </td>
                                            <td>
                                                <form action="{{route('reject_response',$empRequestsRev->id)}}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger">
                                                        <i class="fe-x-circle "></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>thir is no Requests to Review</tr>
                                @endif
                                {{-- <tr>
                                    <td style="width: 36px;">
                                        <img src="{{asset('assets/images/users/user-2.jpg')}}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                    </td>

                                    <td>
                                        <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                        <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                    </td>

                                    <td>
                                        0.00816117 BTC
                                    </td>

                                    <td>
                                        0.00097036 BTC
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card-box">
                    <h4 class="header-title mb-3">Your Latest 20 Login Histories</h4>

                    <div class="table-responsive" style="height: 330px;overflow: auto;">
                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>IP</th>
                                    <th>DateTime</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($loginHistories) > 0)
                                    @foreach ($loginHistories as $index => $loginHistory)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $loginHistory->ip }}</td>
                                            <td>{{ $loginHistory->datetime }}</td>
                                            <td>{{ $loginHistory->details }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>thir is no login history</tr>
                                @endif
                                {{-- <tr>
                                    <td>
                                        <h5 class="m-0 font-weight-normal">Themes Market</h5>
                                    </td>

                                    <td>
                                        Oct 15, 2018
                                    </td>

                                    <td>
                                        $5848.68
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-warning text-warning">Upcoming</span>
                                    </td>

                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end card-box-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->





    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>
    <script>
        var percent = {{ $percentDays }}
        let color = "#168be2"

        if (percent < 25) {
            color = "#de0d26"
        }
        var options = {
            chart: {
                height: 350,
                type: 'radialBar',
            },
            series: [percent],
            labels: ['Progress'],
            fill: {
                colors: [color]
            }

        }

        // var options = {
        //     chart: {
        //         height: 280,
        //         type: "radialBar",
        //     },

        //     series: [{{ $percentDays }}],

        //     colors: ["#20E647"],
        //     plotOptions: {
        //         radialBar: {
        //             hollow: {
        //                 margin: 0,
        //                 size: "70%",
        //             },
        //             track: {
        //                 dropShadow: {
        //                     enabled: true,
        //                     top: 2,
        //                     left: 0,
        //                     blur: 4,
        //                     opacity: 0.15
        //                 }
        //             },
        //             dataLabels: {
        //                 name: {
        //                     offsetY: -10,
        //                     color: "#fff",
        //                     fontSize: "18px"
        //                 },
        //                 value: {
        //                     color: "#fff",
        //                     fontSize: "30px",
        //                     show: true
        //                 }
        //             }
        //         }
        //     },
        //     fill: {
        //         type: "gradient",
        //         gradient: {
        //             shade: "dark",
        //             type: "vertical",
        //             gradientToColors: ["#87D4F9"],
        //             stops: [0, 100]
        //         }
        //     },
        //     stroke: {
        //         lineCap: "round"
        //     },
        //     labels: ["Progress"]
        // };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();

    </script>
@endsection
