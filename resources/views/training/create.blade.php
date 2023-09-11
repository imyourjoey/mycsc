<x-layout>
    <x-navbar />


    <div class="container">

        <div class="mt-4 mb-4">
            <p class="h2">Create Training Programme</p>
            <p>Please fill in the following information to create a new training programme.</p>
        </div>

        <form method="POST" action={{ route('training.store') }} id="createTrainingForm">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <label for="trainingTitle">Title <span class="form-required">*</span></label>
                <input type="text" class="form-control" id="trainingTitle"
                    placeholder="Enter the title of the training programme" name="trainingTitle"
                    value="{{ old('trainingTitle') }}">

                @error('trainingTitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="trainingDesc">Description <span class="form-required">*</span></label>
                <textarea type="text" class="form-control" id="trainingDesc"
                    placeholder="Provide a brief description of the training programme" name="trainingDesc" rows="4">{{ old('trainingDesc') }}</textarea>

                @error('trainingDesc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                  <label for="trainingVenue">Venue <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="trainingVenue"
                        placeholder="Enter the venue of the training programme" name="trainingVenue"
                        value="{{ old('trainingVenue') }}">
  
                  @error('trainingVenue')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              </div>

            <div class="row ">
                <div class="form-group col-md-3 pr-1">
                    <label for="trainerName">Trainer's Name <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="trainerName"
                        placeholder="Enter the name of the trainer" name="trainerName"
                        value="{{ old('trainerName') }}">

                    @error('trainerName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3 pl-1">
                  <label for="trainingCapacity">Maximum Capacity <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="trainingCapacity"
                      placeholder="Enter maximum training capacity" name="trainingCapacity"
                      value="{{ old('trainingCapacity') }}">

                  @error('trainingCapacity')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>


          </div>

          <div class="h5 mt-4 mb-3"> Important Dates and Time</div>
            <div class="row">
                <div class="form-group col-md-2 pr-1">
                    <label for="startDateTime">Start <span class="form-required">*</span></label>
                    <input type="text" class="form-control selector bg-white" value="{{ old('startDateTime') }}" name="startDateTime" placeholder=" -Choose start date-">
            

                    @error('startDateTime')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-2 pr-1 pl-1">
                  <label for="endDateTime">End <span class="form-required">*</span></label>
                  <input type="text" class="form-control selector bg-white" id="endDateTime"
                  placeholder=" -Choose end date-" name="endDateTime"
                      value="{{ old('endDateTime') }}">

                  @error('endDateTime')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group col-md-2 pl-1">
                <label for="regisDeadline">Registration Deadline <span class="form-required">*</span></label>
                <input type="text" class="form-control selector bg-white" id="regisDeadline"
                placeholder=" -Choose deadline-" name="regisDeadline"
                    value="{{ old('regisDeadline') }}">

                @error('regisDeadline')
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
          minDate: "today"
        });

    }); 
    </script>

    
    
    
    
    
    