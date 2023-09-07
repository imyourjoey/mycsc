<x-layout>
    <x-navbar />


    <div class="container">
        <div class="mt-4 mb-4">
            <p class="h2">Create New Service</p>
            <p>Please fill in the following information to create a new service.</p>
        </div>

        <form method="POST" action={{ route('user.create') }} id="createUserForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="title">Service Title <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="title" placeholder="Please enter the service title"
                        name="title" value="{{ old('title') }}">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="description">Description <span class="form-required">*</span></label>
                    <textarea type="text" class="form-control" id="description"
                        placeholder="Please describe the service in detail" name="description"
                        value="{{ old('description') }}" rows="4"></textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="picture">Picture</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="picture" name="picture">
                        <label class="custom-file-label" for="picture">Choose an image for the service</label>
                    </div>

                    @error('picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row ">
                <div class="form-group col-md-3 pr-1">
                    <label for="estDuration">Estimated Duration<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="estDuration" placeholder="Estimated Duration (in Days)"
                        name="estDuration" value="{{ old('estDuration') }}">

                    @error('estDuration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3 pl-1">
                    <label for="adminName">Added By (Admin Name)<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="adminName" placeholder="Enter the name of the admin"
                        name="adminName" value="{{ old('adminName') }}">

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
