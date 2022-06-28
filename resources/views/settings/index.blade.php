@extends('layouts.vertical', ['title' => 'Datatables'])

@section('css')
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .nav-link.active {
            background-color: rgba(247, 247, 247, 0.933) !important
        }

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

        #logo {
            height: 230px;
            width: 230px;
            object-fit: cover;
            border-radius: 100%
        }

        @media only screen and (max-width: 600px) {
            #logo {
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
    <div class="bg-white container-fluid">

        <ul class="nav nav-tabs nav-bordered">
            <li class="nav-item">
                <a href="#account_settings" data-toggle="tab" aria-expanded="false"
                    class="nav-link active font-weight-bold">
                    Account settings
                </a>
            </li>

            <li class="nav-item">
                <a href="#company-settings" data-toggle="tab" aria-expanded="false"
                    class="nav-link font-weight-bold">
                    Company settings
                </a>
            </li>



            <li class="nav-item">
                <a href="#attendence-settings" data-toggle="tab" aria-expanded="false"
                    class="nav-link font-weight-bold">
                    Attendence settings
                </a>
            </li>

        </ul>
        <div class="p-md-4 tab-content">
            {{-- account settings --}}
            <div class="tab-pane p-1 active" id="account_settings">
                @include('settings.info')
            </div>

            {{-- company settings --}}
            <div class="tab-pane p-1" id="company-settings">
                @include('settings.cover')
                @include('settings.logo')
                @include('settings.company-settings')
            </div>

            {{-- attendence settings --}}
            <div class="tab-pane p-1" id="attendence-settings">
                @include('settings.attendence-settings')
            </div>
        </div>



    </div>
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
    <script src="{{ asset('assets/libs/cropper/cropper.min.js') }}"></script>


    <script>

        // initialize switchary
        var elem = document.querySelectorAll('.js-switch');
        elem.forEach(element => {
            new Switchery(element , {
                color : '#64b0f2'
            });
        });


        // cover crop

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
        const enableEditing = () => {
            $("#c_name").removeAttr('disabled');
            $("#c_email").removeAttr('disabled');
            $("#c_address").removeAttr('disabled');
            $("#c_phone").removeAttr('disabled');
            $('#edit-info-btn').removeClass('d-none')
        }

        const enableCompanySettingsEditing = () => {
            $("#ssid_input").removeAttr('disabled');
            $("#mac_address_input").removeAttr('disabled');
            $("#email_input").removeAttr('disabled');
            $("#phone_input").removeAttr('disabled');
            $("#notes_input").removeAttr('disabled');
            $("#notes_input").removeAttr('style');
            $('#edit-company-info-btn').removeClass('d-none')
            
        }



        // toggle attendence settings 

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


@endsection
