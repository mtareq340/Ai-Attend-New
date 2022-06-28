<form action="{{route('updateAccountSettings')}}" method="POST" class="p-3 my-4 border col-md-6 position-relative needs-validation"
novalidate>
    @csrf
    @method('PUT')
    <button type="button" onclick="enableEditing()" class="border-0 outline-0 btn btn-outline-secondary waves-effect waves-light"><i class="fa fa-pen"></i></button>
    <div class="form-group">
        <label for="c_name" class="col-form-label">name</label>
        <input type="text" name="name" class="form-control" id="c_name" value="{{$user->name}}" disabled required>
    </div>

    <div class="form-group">
        <label for="c_address" class="col-form-label">Address</label>
        <input type="email" name="address" class="form-control" id="c_address" value="{{$user->address}}" disabled>
    </div>



    <div class="form-group">
        <label for="c_email" class="col-form-label">Email</label>
        <input type="email" name="email" class="form-control" id="c_email" value="{{$user->email}}" disabled required>
    </div>

    <div class="form-group">
        <label for="c_phone" class="col-form-label">Phone</label>
        <input type="text" name="phone" class="form-control" id="c_phone" value="{{$user->phone}}" disabled required>
    </div>


    <button type="submit" class="my-2 btn btn-primary waves-effect d-none" id="edit-info-btn">save</button>
</form>