<form action="{{route('updateAccountSettings')}}" method="POST" class="p-3 my-4 border position-relative needs-validation"
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
        <input type="text" name="address" class="form-control" id="c_address" value="{{$user->address}}" disabled>
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



<form action="{{ route('change_auth_user_password') }}" method="POST">
    @csrf
    @method('patch')        
    <h1 class="text-2xl my-7">change password</h1>

    <div class="form-group">
        <label for="i_password" class="col-form-label">old password</label>
        <input type="password" name="old_password" class="form-control" id="i_password" required>
    </div>


    <div class="form-group">
        <label for="i_new_password" class="col-form-label">new password</label>
        <input type="password" name="new_password" class="form-control" id="i_new_password" required>
    </div>

    <div class="form-group">
        <label for="i_c_new_password" class="col-form-label">confirm new password</label>
        <input type="password" name="confirm_new_password" class="form-control" id="i_c_new_password" required>
    </div>
    
    <button type="submit" class="btn btn-primary">change password</button>

</form>