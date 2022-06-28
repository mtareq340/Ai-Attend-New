<form action="{{route('updateCompanySettings')}}" method="POST" class="p-3 my-4 border position-relative needs-validation"
novalidate>
    @csrf
    @method('PUT')
    <button type="button" onclick="enableCompanySettingsEditing()" class="border-0 outline-0 btn btn-outline-secondary waves-effect waves-light"><i class="fa fa-pen"></i></button>
    <div class="form-group">
        <label for="ssid_input" class="col-form-label">SSID</label>
        <input disabled type="text" name="ssid" class="form-control" id="ssid_input" value="{{$company_settings->ssid}}">
    </div>

    <div class="form-group">
        <label for="mac_address_input" class="col-form-label">Mac address</label>
        <input disabled type="text" name="mac_address" class="form-control" id="mac_address_input" value="{{$company_settings->mac_address}}">
    </div>

    <div class="form-group">
        <label for="email_input" class="col-form-label">Company Email</label>
        <input disabled type="email" name="email" class="form-control" id="email_input" value="{{$company_settings->email}}">
    </div>

    <div class="form-group">
        <label for="phone_input" class="col-form-label">Company Phone</label>
        <input disabled type="text" name="phone" class="form-control" id="phone_input" value="{{$company_settings->phone}}">
    </div>

    
    <div class="form-group">
        <label for="notes_input" class="col-form-label">Notes <span class="text-muted">(optional)</span></label>
        <textarea style="background: #E1E1E1" disabled name="notes" class="form-control" id="notes_input">{{$company_settings->notes}}</textarea>
    </div>

    <button type="submit" class="my-2 btn btn-primary waves-effect d-none" id="edit-company-info-btn">save</button>
</form>
