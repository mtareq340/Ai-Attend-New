<div class="logo-container">

    <form action="{{ route('changeLogo') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="position-relative">
            <label class="custom-input">
                <input type="file" id="logo" name="logo" accept="image/png, image/jpeg" class="d-none">
            </label>
            <img class="logo" style="box-shadow: box-shadow: rgb(28 32 93 / 24%) 0 2px 8px 0;"
                src="{{ $company_settings['logo'] ? '/assets/images/' . $company_settings['logo'] : '/assets/images/default-logo.png' }}"
                alt="logo" />
        </div>

    </form>


</div>
<div class="d-flex justify-content-center my-2">

    <form action="{{ route('resetLogo') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-dark btn-rounded waves-effect mt-2">reset
            logo</button>
    </form>
</div>



<div class="modal fade" id="modal-logo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="my-2 d-flex">
                    <button type="button" class="mr-2 btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop-logo">Crop and upload</button>
                </div>

                <div class="mb-1 spinner-border text-primary d-none" role="status" id="loader-logo">
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="img-container">
                    <div class="row">
                        <div class="p-0 col-md-12">
                            <img class="w-100" id="image-logo" src="#">
                        </div>
                        <div class="p-0 col-md-12">
                            <div class="preview-logo"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
