@vite('resources/css/appointment.css')
<div class="appointment-container container-fluid">
  <div class="row pt-4 pb-4">
    <div class="col-6">
      <div class="p-0 h2 col-auto ml-5">Check Appointment Status</div>
    </div>
      <div class="col-6">
      <form method="GET" action="{{ route('showGuestAppointment') }}">
        <div class="input-group input-group-lg">
          <input name="guestEmail"  id="guestEmail" type="text" class="form-control" placeholder="Enter your email to check appointment status">
          
          <div class="input-group-append">
            <button class="btn btn-primary text-white" href="{{ route('showGuestAppointment') }}">
              Check <i class="fa fa-search"></i>
            </button>
          </div>
        </div>

      </form>
        @error('guestEmail')
          <div class="invalid-feedback text-white">{{ $message }}</div>
          @enderror
      
      </div>
    

  </div>

</div>