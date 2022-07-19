@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="p-4">

    
@include('settings.tabs')
  




<div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Allow delay</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'allow_delay') " class="js-switch" {{$attendence_settings->allow_delay?'checked':''}} data-plugin="switchery" />
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Automatic leave</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'automatic_leave')" {{$attendence_settings->automatic_leave?'checked':''}} class="js-switch" data-plugin="switchery" />
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Validate finger</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'validate_finger')" {{$attendence_settings->validate_finger?'checked':''}} class="js-switch" data-plugin="switchery" />
        </div>
    </div>

    {{-- <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Validate finger</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'validate_finger')" {{$attendence_settings->validate_finger?'checked':''}} class="js-switch" data-plugin="switchery" />
        </div>
    </div> --}}
    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Extra Time</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" id="toggleextra" onchange="activeextra()"  class="js-switch" data-plugin="switchery" />
        </div>
    </div>
    <div class="form-group row mb-3" id="extratime" style="display: none">
        <label for="">Fill OverTime</label>
        <form action="{{route('branch_setting.update',$extra_time[0]->id)}}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <div class="col-6">
                <input type="text" name="over_time_count" value="{{$extra_time[0]->over_time_count}}" class="form-control">
                </div>
                <div class="col-3">
                <button type="submit" class="btn btn-success">Add Max Overtime</button>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Vacation Days</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" id="toggle" onchange="activevication()"  class="js-switch" data-plugin="switchery" />
        </div>
    </div> --}}
    <label class="" for="">Select Vacation Days</label>

    <div class="form-group row mb-3 ml-2" id="vication" >
        <form action="{{route('addvication')}}" method="POST">
            @csrf
            @foreach($list_of_days as $day)
               <div class="checkbox checkbox-success form-check-inline">
                   <input type="checkbox" name="days[]" id="" {{ $day['selected'] ? 'checked':''}} value="{{$day['id']}}"  >
                   <label for="inlineCheckbox{{$day['id']}}"> {{$day['days']}} </label>
                </div>
            @endforeach
            <br>
            <button type="submit" class="btn btn-success mt-2">Add Vacation</button>
        </form>
        </div>

        <div class="form-group mb-3 ml-2">
            <form action="" method="POST">
                @csrf
                <input type="submit" class="btn btn-success" value="automatic Departure">
            </form>
        </div>
    </div>

    {{-- <form action="{{}}">
        <div class="row mb-3">
            <div class="col-6 col-lg-3">
                <span>Extra time</span>
            </0div>
            <div class="col-6 col-lg-4">          
            </div>
        </div>
        <button class="btn btn-primary mt-4" type="submit">Update</button>
    </form> --}}
</div>
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{ asset('assets/libs/cropper/cropper.min.js') }}"></script>


    <script>
        const enableCompanySettingsEditing = () => {
            $("#ssid_input").removeAttr('disabled');
            $("#mac_address_input").removeAttr('disabled');
            $("#email_input").removeAttr('disabled');
            $("#phone_input").removeAttr('disabled');
            $("#notes_input").removeAttr('disabled');
            $("#notes_input").removeAttr('style');
            $('#edit-company-info-btn').removeClass('d-none')
            
        }
        const toggleAttendenceSettings = (e , type) => {
            (async () => {
                try {
                    let checked = e.target.checked;
                    const rawResponse = await fetch('{{ route('toggleAttendenceSettings') }}', {
                        method: 'PATCH',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
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
    {{-- <script>
        function activevication(){
            let isChecked = $('#toggle')[0].checked
            console.log(isChecked);
            let v = document.getElementById('vication');
            if(isChecked){
                v.style.display ='block';
            }
            else{
                v.style.display ='none';
            }
        }
    </script> --}}
    <script>
        function activeextra(){
            let isChecked = $('#toggleextra').is(':checked');
            console.log(isChecked);
            let extratime = document.getElementById('extratime');
            if(isChecked){
                extratime.style.display ='block';
            }
            else{
                extratime.style.display ='none';
            }
        }
    </script>
@endsection
