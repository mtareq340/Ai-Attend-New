     {{-- logo --}}
     <div class="bg-banner"
     style="background-image: url('/assets/images/{{ $company_settings['background'] ? $company_settings['background'] : 'default-cover.jpg' }}')">
     <form method="POST" action="{{ route('changeCover') }}" enctype="multipart/form-data">
         @csrf
         @method('patch')

         <label class="m-1 btn btn-outline-light waves-effect waves-light">
             <i class="fa fa-upload"></i>
             <span>Change cover image</span>
             <input type="file" name="cover" onclick="clearInput()" accept="image/png, image/jpeg" class="d-none image" id="cover">
         </label>
     </form>
 </div>


 
 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" id="crop">Crop and upload</button>
                </div>

                <div class="mb-1 spinner-border text-primary d-none" role="status" id="loader">
                    <span class="sr-only">Loading...</span>
                  </div>

                <div class="img-container">
                    <div class="row">
                        <div class="p-0 col-md-12">
                            <img class="w-100" id="image" src="#">
                        </div>
                        <div class="p-0 col-md-12">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>