<x-layout>
    <x-navbar />


    <div class="container">
        <div class="mb-4 mt-4">
            <p class="h2">Create New Service</p>
            <p>Please fill in the following information to create a new service.</p>
        </div>

        <form method="POST" action={{ route('service.store') }} id="createUserForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="serviceTitle">Service Title <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="serviceTitle" placeholder="Please enter the service title"
                        name="serviceTitle" value="{{ old('serviceTitle') }}">

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
                        rows="4">{{ old('serviceDesc') }}</textarea>

                    @error('serviceDesc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="servicePic">Picture <span class="form-required">*</span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="servicePic" name="servicePic">
                        <label class="custom-file-label" for="servicePic">Choose an image for the service</label>
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
                        name="estDuration" value="{{ old('estDuration') }}">

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
                    <button type="submit" class="btn btn-primary btn-block">Enroll <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>
        </form>
    </div>
</x-layout>


<script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
