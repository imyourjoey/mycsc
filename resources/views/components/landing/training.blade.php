<div class="container-fluid">
  <div class="h2 ml-5 pt-4 mb-4">Training</div>

  <div class="row justify-content-center">
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
                            <div>Starting Date & Time: {{ $training->startDateTime }}</div>
                            <div>Ending Date & Time: {{ $training->endDateTime }}</div>
                            <div>Venue: {{ $training->trainingVenue }}</div>
                            <div>Capacity: {{ $training->trainingCapacity }}</div>
                            <div>Instructor: {{ $training->trainerName }}</div>
                            <div>Registration Deadline: {{ $training->regisDeadline }}</div>
                            
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>