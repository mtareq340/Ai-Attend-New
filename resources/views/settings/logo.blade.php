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
                src="{{ $settings['logo'] ? '/assets/images/'.$settings['logo'] : '/assets/images/default-logo.jpg' }}"
                alt="logo" />
        </div>
    </form>

</div>