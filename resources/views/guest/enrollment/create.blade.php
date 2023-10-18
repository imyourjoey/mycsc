<x-layout>
  <x-navbar />
  <div class="container">

      <div class="mt-4">
        <div class="row">
            <div class="form-group col-md-6">
            <p class="h1">Training Information</p>
            <p class="h4 text-justify">{{ $training->trainingTitle }}</p>
             <p class="text-justify form-group">{{ $training->trainingDesc }}</p>

             <p class="mt-2"> Venue: {{ $training->trainingVenue }}</p>
             
             <p class="mt-2"> Starting Date & Time:  {{ \Carbon\Carbon::parse($training->startDateTime)->format('h:i a, d M Y ') }}</p>
             
             <p class="mt-2"> Ending Date & Time:  {{ \Carbon\Carbon::parse($training->endDateTime)->format('h:i a, d M Y ') }}</p>
             
             <p class="mt-2"> Enrollment Deadline:   {{ \Carbon\Carbon::parse($training->enrollmentDeadline)->format('h:i a, d M Y ') }}</p>


             

            </div>
        </div>
          
      </div>

      <form method="POST" action={{ route('submitGuestEnrollment') }} id="createInquiryForm">
          @csrf
          <input type="hidden" name="trainingID" value="{{ $training->trainingID }}">
          <div class="row">
            <div class=" col-md-6 mt-3">
                <div class="h1">Enrollment Form</div>
                <div>
                    <p>Please submit the form below to enroll to a training program.</p>
                </div>
            </div>
            
          </div>
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="name">Name <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="name" placeholder="Enter your full name" name="name"
                      value="{{ old('name') }}">

                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="email">Email <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="email" placeholder="Enter your email address"
                      name="email" value="{{ old('email') }}">

                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
                <label for="phoneNo">Phone No. <span class="form-required">*</span></label>
                <input type="text" class="form-control" id="phoneNo" placeholder="Enter your phone number"
                    name="phoneNo" value="{{ old('phoneNo') }}">

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
