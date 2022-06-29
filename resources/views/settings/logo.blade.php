<div class="logo-container">
    <form action="{{ route('uploadLogo') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="position-relative">
            <label class="custom-input">
                <input type="file" id="logo-input" name="logo" accept="image/png, image/jpeg" class="d-none"
                    onchange="form.submit()">
            </label>
            <img id="logo"
                src="{{ $company_settings['logo'] ? '/assets/images/'.$company_settings['logo'] : '/assets/images/default-logo.jpg' }}"
                alt="logo" />
        </div>
    </form>

</div>