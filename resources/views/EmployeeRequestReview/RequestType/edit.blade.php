@extends('layouts.vertical', ['title' => 'Form Components'])
@section('textArea')
<style>
    .shadow-textarea textarea.form-control::placeholder {
        font-weight: 300;
    }
    .shadow-textarea textarea.form-control {
        padding-left: 0.8rem;
    }
</style>
@endsection
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
                            <li class="breadcrumb-item"><a href="{{route('employee_request_type.index')}}">Request Type</a></li>
                            <li class="breadcrumb-item active">Edit Request Type</li>

                        </ol>
                    </div>
                    <h4 class="page-title">Edit Request Type</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 




        <!-- Form row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Request Type</h4>
                      
                        <form action="{{ route('employee_request_type.update',$types->id)}}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="name" name="name" class="form-control" value="{{$types->name}}" id="name"required>
                            </div>

                            <div class="form-group shadow-textarea">
                                <label for="exampleFormControlTextarea6">Note</label>
                                <textarea class="form-control z-depth-1" name="note" id="exampleFormControlTextarea6" rows="3" placeholder="{{$types->note}}"></textarea>
                            </div>

                            <center><button type="submit" class="btn btn-success waves-effect waves-light">Update</button></center>

                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


        
    </div> <!-- container -->
@endsection