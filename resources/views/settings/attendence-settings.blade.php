<form >
    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Allow delay</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'allow_delay') " class="js-switch" {{$attendece_settings->allow_delay?'checked':''}} data-plugin="switchery" />
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Automatic leave</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'automatic_leave')" {{$attendece_settings->automatic_leave?'checked':''}} class="js-switch" data-plugin="switchery" />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Extra time</span>
        </div>
        <div class="col-6 col-lg-4">          
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-6 col-lg-3">
            <span>Validate finger</span>
        </div>
        <div class="col-6 col-lg-4">
            <input type="checkbox" onchange="toggleAttendenceSettings(event, 'validate_finger')" {{$attendece_settings->validate_finger?'checked':''}} class="js-switch" data-plugin="switchery" />
        </div>
    </div>

</form>