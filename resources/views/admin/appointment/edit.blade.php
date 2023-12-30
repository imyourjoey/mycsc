
<x-layout>
  <style>
    .btn-light{
      background-color: #FFF;
      color: #000;
  }
  
  
  </style>
    <x-navbar />
  
    <div class="container">
  
  
        <div class="mt-4 mb-4">
            @if(session()->has('message'))
            <div class="row">
                <div class="form-group col-md-6">
                    <a href="{{ route('admin.appointment.index') }}">
                    <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Appointments</button>
                    </a>   
                </div>
            </div>
          @endif
            <p class="h2">Edit Appointment Details</p>
            <p>Please fill in the following information to edit appointment details.</p>
        </div>
  
        <form method="POST" action="{{ route('admin.appointment.update', ['appointment' => $appointment]) }}" id="editAppointmentForm">
        @csrf
        @method('PUT') <!-- Use the PUT method for updating -->
        <div class="row">
          <div class="form-group col-md-6">
              <label for="clientName">Client Name <span class="form-required">*</span></label>
              <input type="text" class="form-control" id="clientName" name="clientName"
                  value="{{ old('clientName') ?? $appointment->appointmentName }}" readonly>
      
              @error('clientName')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>
      </div>
      
  
      <div class="row">
        <div class="form-group col-md-6">
            <label for="datetime">Date and Time <span class="form-required">*</span></label>
            <input type="text" class="form-control selector bg-white" id="datetime"
                placeholder="Select date and time for the appointment" name="datetime"
                value="{{ old('datetime') ?? $appointment->appointmentDateTime->format('j/m/y h:i A') }}">
    
            @error('datetime')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
  
    <div class="row">
      <div class="form-group col-md-6">
          <label for="remarks">Remarks </label>
          <input type="text" class="form-control" id="remarks"
              placeholder="Add remarks here (optional)" name="remarks"
              value="{{ old('remarks') ?? $appointment->remarks }}">
  
          @error('remarks')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
  </div>
  

  <div class="row">
    <div class="form-group col-md-6">
        <label for="status">Status <span class="form-required">*</span></label>
        <select name="status" id="status" class="form-control">
            <option value="pending" @if(old('status', $appointment->appointmentStatus) === 'pending' ) selected @endif>Pending</option>
            <option value="approved" @if(old('status', $appointment->appointmentStatus) === 'approved' ) selected @endif>Approved</option>
        </select>

        @error('status')
        <div class="invalid-feedback" id="status-error">{{ $message }}</div>
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
  
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          //initialize Datepicker
  $(".selector").flatpickr({
            dateFormat: "d/m/y H:i",
            enableTime: true,
            time_24hr: true,
            minDate: "today",
            minTime: "09:00"
          });
  
      }); 
      </script>
  