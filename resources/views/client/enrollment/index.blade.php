<x-layout>
  <x-navbar/>
  <div class="container-fluid">
      <div class="h2 pt-4 mb-4 font-weight-bold">Training Programmes</div>

      <div class="row">
        <div class="col-9">
            <div class="accordion" id="accordionExample">
                @foreach($trainings as $training)
                    <div class="card">
                        <div class="card-header" id="heading{{ $training->trainingID }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left text-dark" type="button"
                                    data-toggle="collapse" data-target="#collapse{{ $training->trainingID }}"
                                    aria-expanded="false"
                                    aria-controls="collapse{{ $training->trainingID }}">
                                    {{ $training->trainingTitle }}
                                </button>
                            </h2>
                        </div>
                        <div id="collapse{{ $training->trainingID }}" class="collapse show" aria-labelledby="heading{{ $training->trainingID }}"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                
                                <div>Description: {{ $training->trainingDesc }}</div>
                                <div>Starting Date & Time: {{ \Carbon\Carbon::parse($training->startDateTime)->format('d M Y, h:ia') }}</div>
                                <div>Ending Date & Time: {{ \Carbon\Carbon::parse($training->endDateTime)->format('d M Y, h:ia') }}</div>
                                <div>Venue: {{ $training->trainingVenue }}</div>
                                <div>Capacity: {{ $training->trainingCapacity }}</div>
                                <div>Instructor: {{ $training->trainerName }}</div>
                                <div>Registration Deadline: {{ \Carbon\Carbon::parse($training->regisDateline)->format('d M Y, h:ia') }}</div>
                                
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    



    {{-- enroll training program --}}
    <div class="row">
      <div class="col-8">
        <div class="h2 mt-5 mb-2 font-weight-bold">Enrol Training Program</div>

        <form method="POST" action={{ route('client.enrollment.store') }} id="trainingEnrollmentForm" enctype="multipart/form-data">
          @csrf
          
            <div class="row">
              <div class="form-group col-md-6">
                  <input type="text" class="form-control selector bg-white"  id="datetime"
                      placeholder="Select Appointment Date and Time" name="datetime" value="{{ old('datetime') }}">

                      @error('datetime')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>

          
          </div>




          





          <div class="row">
              <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-primary btn-block">Enrol <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
      </div>
    </div>
  </div>
  
  
</x-layout>