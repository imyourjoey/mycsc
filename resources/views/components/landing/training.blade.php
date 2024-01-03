@vite('resources/css/training.css')

<div class="container-fluid" style="margin-bottom:200px">
  <div class="h2 ml-5 pt-4 mb-5">Training</div>

  <div class="row justify-content-center">
    <div class="col-9">
        <div class="training-accordion-container">
        <div class="accordion" id="accordionExample">

@if ($trainings)
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
            <div>Starting Date & Time: {{ $training->startDateTime->format('j/m/y h:i A') }}</div>
<div>Ending Date & Time: {{ $training->endDateTime->format('j/m/y h:i A') }}</div>
            <div>Venue: {{ $training->trainingVenue }}</div>
            <div>Capacity: {{ $training->trainingCapacity }}</div>
            <div>Instructor: {{ $training->trainerName }}</div>
            <div>Registration Deadline: {{ $training->regisDeadline->format('j/m/y h:i A') }}</div>
            <div class="mt-2">
                <a class="btn btn-primary text-white" href="{{ route('showGuestEnrollment', ['trainingID' => $training->trainingID] )}}" >Enrol Now!</a>
              </div> 
            
        </div>
    </div>
</div>
@endforeach
@endif

        </div>
        <img src="{{ asset('img/training.svg') }}" class="training-image wow animate__animated animate__fadeInRight animate__slow" data-wow-offset="100">
    </div>
    </div>
</div>



</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Assuming $training->startDateTime and $training->endDateTime are ISO 8601 date strings
        var startDateTime = moment("{{ $training->startDateTime }}").format('DD/MM/YYYY hh:mm A');
        var endDateTime = moment("{{ $training->endDateTime }}").format('DD/MM/YYYY hh:mm A');

        document.getElementById('startDateTime').textContent = startDateTime;
        document.getElementById('endDateTime').textContent = endDateTime;
    });
</script>