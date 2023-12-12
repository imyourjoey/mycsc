<x-layout>
  <x-navbar />

  



  <div class="container">
    
      <div class="mt-4 mb-4">
        @if(session()->has('message'))
        <div class="row">
            <div class="form-group col-md-6">
                <a href="{{ route('admin.service.index') }}">
                <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Services</button>
                </a>   
            </div>
        </div>
    @endif
          <p class="h2">Edit Service Details</p>
          <p>Please fill in the following information to edit service details.</p>
      </div>

      <form method="POST" action={{ route('admin.service.update',['service' => $service->serviceID]) }} id="createUserForm" enctype="multipart/form-data">
          @csrf
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="serviceTitle">Service Title <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="serviceTitle" placeholder="Please enter the service title"
                      name="serviceTitle" value="{{ old('serviceTitle', $service->serviceName ) }}">

                  @error('serviceTitle')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

          </div>


          <div class="row">
              <div class="form-group col-md-6">
                  <label for="serviceDesc">Description <span class="form-required">*</span></label>
                  <textarea type="text" class="form-control" id="serviceDesc"
                      placeholder="Please describe the service in detail" name="serviceDesc"
                      rows="4">{{ old('serviceDesc' , $service->serviceDesc) }}</textarea>

                  @error('serviceDesc')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

          </div>

          

          <div class="row">
              <div class="form-group col-md-6">
                
                  <label for="servicePic">Current Image</label>
                  @if ($service->servicePic)
                      <img class="mw-100 d-block border" src="{{ asset('storage/'.$service->servicePic) }}" alt="Current Image">
                  @else
                      <p>No picture available.</p>
                  @endif
                  <div class="custom-file mt-2">
                      <input type="file" class="custom-file-input" id="servicePic" name="servicePic">
                      <label class="custom-file-label" for="servicePic">No file chosen</label>
                      <small class="form-text text-muted">
                        Upload a new image if you wish to replace the current one.
                      </small>
                  </div>

                  @error('servicePic')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row ">
              <div class="form-group col-md-3 pr-1">
                  <label for="estDuration">Estimated Duration <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="estDuration" placeholder="Estimated Duration (in Days)"
                      name="estDuration" value="{{ old('estDuration', $service->serviceEstDuration) }}">

                  @error('estDuration')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group col-md-3 pl-1">
                  <label for="adminName">Added By (Admin Name) <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="adminName" placeholder="Enter the name of the admin"
                      name="adminName" value="{{ auth()->user()->name }}" readonly>

                  @error('adminName')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>


          </div>



          <div class="row">
              <div class="form-group col-md-6">
                  <br>
                  <button type="submit" class="btn btn-primary btn-block">Update <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
  </div>
</x-layout>


{{-- <script>
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
  </script> --}}
