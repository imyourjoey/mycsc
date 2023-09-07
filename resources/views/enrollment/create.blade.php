<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
          <p class="h2">Enrol in a Training Programme!</p>
          <p>Please fill in the following information to enroll to a training programme.</p>
      </div>

      <form method="POST" action={{ route('user.create') }} id="createUserForm">
          @csrf
          <div class="row">
            <div class="form-group col-md-6">
              <label for="title">Programme Title <span class="form-required">*</span></label>
              <input type="text" class="form-control" id="title"
                  placeholder="Please choose the training program you wish to enroll in"
                  name="title"
                  value="{{ old('title') }}">

              @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

          </div>

          
          <div class="row">
            <div class="form-group col-md-6">
              <div class="h5 mt-4 mb-3"> Applicant Details</div>
              <label for="name">Name<span class="form-required">*</span></label>
              <input type="text" class="form-control" id="name"
                  placeholder="Please choose the training program you wish to enroll in"
                  name="name"
                  value="{{ old('name') }}">

              @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="email">Email<span class="form-required">*</span></label>
              <input type="text" class="form-control" id="email"
                  placeholder="Email address (e.g., name@example.com)"
                  name="email"
                  value="{{ old('email') }}">

              @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="phoneNo">Contact Number<span class="form-required">*</span></label>
              <input type="text" class="form-control" id="phoneNo"
                  placeholder="Enter your phone number (e.g., 012-4567890)"
                  name="phoneNo"
                  value="{{ old('phoneNo') }}">

              @error('phoneNo')
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
