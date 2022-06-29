@extends('layouts.vertical', ['title' => 'Form Components'])

@section('content')

        @if(session()->has('message'))
        {{dd('vbnm')}}
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('attend_methods.index')}}">Attend Methods</a></li>
                            <li class="breadcrumb-item active">Edit Attend Methods</li>

                        </ol>
                    </div>
                    <h4 class="page-title">Edit attend_methods</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Attend Methodss</h4>
                      
                        <form action="{{ route('attend_methods.update', $attend_methods->id)}}" method="post" class="needs-validation" novalidate>
                            {{ csrf_field() }}
							{{ method_field('PATCH') }}

                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="name" value="{{ $attend_methods->name }}" name="name" class="form-control" id="name" placeholder="Name" required>
                            </div>
                            
                            <div class="form-group shadow-textarea">
                                <label for="exampleFormControlTextarea6">Note</label>
                                <textarea class="form-control z-depth-1"  name="notes" id="exampleFormControlTextarea6" rows="3" placeholder="Write note Here ...">{{ $attend_methods->notes  }}</textarea>
                            </div>

                            

                            <center> <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button> </center>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


        
    </div> <!-- container -->
@endsection