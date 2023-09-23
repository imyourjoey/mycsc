
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
          <p class="h2">Schedule An Appointment</p>
          <p>Please fill in the following information to schedule an appointment.</p>
      </div>

      <form method="POST" action={{ route('admin.appointment.store') }} id="createAppointmentForm">
      @csrf
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="clientName">Client Name <span class="form-required">*</span></label>
                  <select class="selectpicker form-control border" id="clientName" data-live-search="true" name="clientName">
                    <option disabled selected >-Enter client name-</option>
                    @foreach ($clients as $client)
                    <option value="{{ $client->name }}" @if(old('clientName')=== $client->name ) selected @endif>{{ $client->name }} - {{ $client->userTag }}</option>
                  @endforeach
                  </select>

                @error('clientName')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="datetime">Date and Time <span class="form-required">*</span></label>
                  <input type="text" class="form-control selector bg-white"  id="datetime"
                      placeholder="Select date and time for the appointment" name="datetime" value="{{ old('datetime') }}">

                      @error('datetime')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>

          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="remarks">Remarks </label>
              <input type="text" class="form-control" id="remarks"
                  placeholder="Add remarks here (optional)" name="remarks" value="{{ old('remarks') }}">

                  @error('remarks')
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //initialize Datepicker
$(".selector").flatpickr({
          dateFormat: "Y-m-d H:i",
          enableTime: true,
          time_24hr: true,
          minDate: "today",
          minTime: "09:00",
          defaultDate:"{{ $selectedDate }}"
        });

    }); 
    </script>
