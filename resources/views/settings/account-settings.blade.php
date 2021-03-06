
@extends('layouts.vertical', ['title' => 'Datatables'])
@section('content')
<div class="p-4">
@include('settings.tabs')

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


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
    Change password
</button>


<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">change password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('change_auth_user_password') }}" method="POST">
                @csrf
                @method('patch')        
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
                
                <button type="submit" class="btn btn-success">change password</button>
            
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

  
@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
<script src="{{ asset('assets/libs/cropper/cropper.min.js') }}"></script>


<script>

            
    const enableEditing = () => {
        $("#c_name").removeAttr('disabled');
        $("#c_email").removeAttr('disabled');
        $("#c_address").removeAttr('disabled');
        $("#c_phone").removeAttr('disabled');
        $('#edit-info-btn').removeClass('d-none')
    }


</script>


@endsection
