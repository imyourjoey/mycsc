<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
          <p class="h2">Schedule an appointment with us!</p>
          <p>Please complete the form below to schedule an appointment.</p>
      </div>

      <form method="POST" id="createAppointmentForm" action=" {{ route('submitGuestAppointmentForm') }}">
          @csrf

          <div class="row">
            <div class="form-group col-md-6">
              <label for="datetime">Date and Time<span class="form-required">*</span></label>
                <input type="text" class="form-control selector bg-white"  id="datetime"
                    placeholder="Select Appointment Date and Time" name="datetime" value="{{ old('datetime') }}">

                    @error('datetime')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

        
        </div>

          <div class="row">
            
                <div class="form-group col-md-6">
                    <label for="name">Name<span class="form-required">*</span></label>
                    <input type="name" class="form-control" id="name"
                        placeholder="Your full name, eg. Jane Doe" name="name"
                        value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
          

          </div>
          <div class="row">
            
            <div class="form-group col-md-6">
                <label for="phoneNo">Phone No.<span class="form-required">*</span></label>
                <input type="phoneNo" class="form-control" id="phoneNo"
                    placeholder="Your phone number, eg. 012-3456789" name="phoneNo"
                    value="{{ old('phoneNo') }}">

                @error('phoneNo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
      

          </div>

          <div class="row">
            
            <div class="form-group col-md-6">
                <label for="email">Email<span class="form-required">*</span></label>
                <input type="email" class="form-control" id="email"
                    placeholder="Your email address, eg. youremail@email.com" name="email"
                    value="{{ old('email') }}">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
      

          </div>

          

          <div class="row">
              <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-primary btn-block">Submit <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
  </div>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      //initialize Datepicker
$(".selector").flatpickr({
        dateFormat: "Y-m-d H:i",
        enableTime: true,
        time_24hr: true,
        minDate: "today",
        minTime: "09:00"
      });

  }); 
  </script>
