<x-layout>
    <x-navbar />


    <div class="container">

        <div class="mt-4 mb-4">
            <p class="h2">Create Training Programme</p>
            <p>Please fill in the following information to create a new training programme.</p>
        </div>

        <form method="POST" action={{ route('user.create') }} id="createUserForm">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Title <span class="form-required">*</span></label>
                <input type="text" class="form-control" id="name"
                    placeholder="Enter the title of the training programme" name="name"
                    value="{{ old('name') }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Description <span class="form-required">*</span></label>
                <textarea type="text" class="form-control" id="name"
                    placeholder="Provide a brief description of the training programme" name="name"
                    value="{{ old('name') }}" rows="4"></textarea>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>

            <div class="row ">
                <div class="form-group col-md-3 pr-1">
                    <label for="email">Trainer's Name<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="email"
                        placeholder="Enter the name of the trainer" name="email"
                        value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3 pl-1">
                  <label for="email">Maximum Capacity<span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="email"
                      placeholder="Enter maximum training capacity" name="email"
                      value="{{ old('email') }}">

                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>


          </div>

          <div class="h5 mt-4 mb-3"> Important Dates and Time</div>
            <div class="row">
                <div class="form-group col-md-2 pr-1">
                    <label for="phoneNo">Start <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="phoneNo"
                        placeholder="Enter your phone number (e.g., 012-4567890)" name="phoneNo"
                        value="{{ old('phoneNo') }}">

                    @error('phoneNo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-2 pr-1 pl-1">
                  <label for="phoneNo">End <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="phoneNo"
                      placeholder="Enter your phone number (e.g., 012-4567890)" name="phoneNo"
                      value="{{ old('phoneNo') }}">

                  @error('phoneNo')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group col-md-2 pl-1">
                <label for="phoneNo">Registration Deadline <span class="form-required">*</span></label>
                <input type="text" class="form-control" id="phoneNo"
                    placeholder="Enter your phone number (e.g., 012-4567890)" name="phoneNo"
                    value="{{ old('phoneNo') }}">

                @error('phoneNo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Create <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>
        </form>
    </div>
</x-layout>
