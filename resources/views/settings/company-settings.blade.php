@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <link href="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .bg-banner {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 100%;
            min-height: 400px;
            max-height: 600px;
            min-width: 350px;
        }

        input:disabled {
            background: rgba(223, 223, 223, 0.933) !important
        }

        .logo-container {
            position: relative;
            top: -40px;
            display: flex;
            justify-content: center
        }

        .logo {
            height: 230px;
            width: 230px;
            object-fit: cover;
            border-radius: 100%
        }

        @media only screen and (max-width: 600px) {
            .logo {
                height: 140px;
                width: 140px;
            }
        }

        .custom-input {
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 100%;
            padding: 6px 12px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: 0.5s ease-in-out all;
        }

        .custom-input:hover {
            opacity: 1;
        }

        .custom-input::before {
            content: "change logo";
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
        }

    </style>
@endsection
@section('content')
    <div class="p-4">
        @include('settings.tabs')

        @include('settings.cover')
        @include('settings.logo')
        <form action="{{ route('company-settings.update', $company_settings->id) }}" method="POST"
            class="p-3 my-4 border position-relative needs-validation" novalidate>
            @csrf
            @method('PUT')
            <button type="button" onclick="enableCompanySettingsEditing()"
                class="border-0 outline-0 btn btn-outline-secondary waves-effect waves-light"><i
                    class="fa fa-pen"></i></button>

            <div class="form-group">
                <label class="col-form-label">Regestration Number</label>
                <input disabled readonly type="text" class="form-control"
                    value="will be gotten from the api (can't be edited)">
            </div>

            <div class="form-group">
                <label for="ssid_input" class="col-form-label">SSID</label>
                <input disabled type="text" name="ssid" class="form-control" id="ssid_input"
                    value="{{ $company_settings->ssid }}">
            </div>

            <div class="form-group">
                <label for="mac_address_input" class="col-form-label">Mac address</label>
                <input disabled type="text" name="mac_address" class="form-control" id="mac_address_input"
                    value="{{ $company_settings->mac_address }}">
            </div>

            <div class="form-group">
                <label for="email_input" class="col-form-label">Company Email</label>
                <input disabled type="email" name="email" class="form-control" id="email_input"
                    value="{{ $company_settings->email }}">
            </div>

            <div class="form-group">
                <label for="phone_input" class="col-form-label">Company Phone num 1</label>
                <input disabled type="text" name="phone" class="form-control" id="phone_input" required value="{{$company_settings->phone}}" >
            </div>


            <div class="form-group">
                <label for="phone_input" class="col-form-label">Company Phone num 2</label>
                <input disabled type="text" name="phone" class="form-control" id="phone2_input" value="{{$company_settings->phone_num2}}">
            </div>


            <div class="form-group">
                <label for="notes_input" class="col-form-label">Notes <span class="text-muted">(optional)</span></label>
                <textarea style="background: #E1E1E1" disabled name="notes" class="form-control"
                    id="notes_input">{{ $company_settings->notes }}</textarea>
            </div>

            <button type="submit" class="my-2 btn btn-primary waves-effect d-none" id="edit-company-info-btn">save</button>
        </form>
    </div>
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/cropper/cropper.min.js') }}"></script>


    <script>
        const enableCompanySettingsEditing = () => {
            $("#ssid_input").removeAttr('disabled');
            $("#mac_address_input").removeAttr('disabled');
            $("#email_input").removeAttr('disabled');
            $("#phone_input").removeAttr('disabled');
            $('#phone2_input').removeAttr('disabled');
            $("#notes_input").removeAttr('disabled');
            $("#notes_input").removeAttr('style');
            $('#edit-company-info-btn').removeClass('d-none')
        }



        var $modal = $('#modal');
        var image = $('#image');
        var options = {
            aspectRatio: 3,
            preview: '.preview',

        };
        $("#cover").on("change", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.attr('src', url)
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                done(URL.createObjectURL(file));
            }
        });

        $modal.on('shown.bs.modal', function() {
            image = $('#image').cropper(options)

        }).on('hidden.bs.modal', function() {
            image.cropper('destroy');
        });

        $("#crop").click(function() {
            var canvas = image.cropper('getCroppedCanvas');

            // canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {
                $('#loader').removeClass('d-none')
                var url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('changeCover') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'patch',
                            'cover': base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            window.location.reload()
                            $('#loader').addClass('d-none')

                        },
                        error: function(error) {
                            console.log(error);
                            $('#loader').addClass('d-none')
                            window.location.reload()
                        }
                    });
                }
            });
        })

        const clearInput = () => {
            $('#cover').val('')
        }





        var $modalLogo = $('#modal-logo');
        var imageLogo = $('#image-logo');
        var optionsLogo = {
            aspectRatio: 1,
            preview: '.preview-logo',

        };
        $("#logo").on("change", function(e) {
            var files = e.target.files;
            var done = function(url) {
                imageLogo.attr('src', url)
                $modalLogo.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                done(URL.createObjectURL(file));
            }
        });

        $modalLogo.on('shown.bs.modal', function() {
            imageLogo = $('#image-logo').cropper(optionsLogo)

        }).on('hidden.bs.modal', function() {
            imageLogo.cropper('destroy');
        });

        $("#crop-logo").click(function() {
            var canvas = imageLogo.cropper('getCroppedCanvas');

            // canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {
                $('#loader').removeClass('d-none')
                var url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('changeLogo') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'patch',
                            'logo': base64data
                        },
                        success: function(data) {
                            $modalLogo.modal('hide');
                            window.location.reload()
                            $('#loader-logo').addClass('d-none')

                        },
                        error: function(error) {
                            console.log(error);
                            $('#loader-logo').addClass('d-none')
                            window.location.reload()
                        }
                    });
                }
            });
        })

    </script>


@endsection
