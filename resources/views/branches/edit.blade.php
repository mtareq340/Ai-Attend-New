@extends('layouts.vertical', ['title' => 'Form Components'])

@section('content')


    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('branches.index') }}">Branchs</a></li>
                            <li class="breadcrumb-item active">Edit Branchs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit {{ $branch->name }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('branches.update', $branch->id) }}" method="post" class="needs-validation" novalidate>
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name @include('red_star')</label>
                                <input type="name" value="{{ $branch->name }}" name="name" class="form-control" id="name"
                                    placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <label for="inputphone" class="col-form-label">Phone number</label>
                                <input type="tel" value="{{ $branch->phone }}" name="phone" class="form-control"
                                    id="inputphone" placeholder="branch phone number" required>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress" class="col-form-label">Address <span
                                        class="text-muted">(optional)</span></label>
                                <input type="text" value="{{ $branch->address }}" name="address" class="form-control"
                                    id="inputAddress" placeholder="1234 Main St">
                            </div>

                            <div class="form-group">
                                <label for="inputNotes" class="col-form-label">Notes <span
                                        class="text-muted">(optional)</span></label>
                                <input type="text" value="{{ $branch->notes }}" name="notes" class="form-control"
                                    id="inputNotes" placeholder="...">
                            </div>

                            <center> <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                            </center>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->



    </div> <!-- container -->
@endsection
