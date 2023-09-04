<x-layout>
<x-navbar/>



<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-lg-12 mt-5 mb-5">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    
  </body>


  {{-- Modal --}}
<form>
  @csrf
<div class="modal hide fade" id="appointmentModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="client_name">Client Name</label>
          <select class="form-control selectpicker" id="client_name" data-live-search="true">
            @foreach ($clients as $client)
            <option>{{ $client->clientName }}</option>
          @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="appointmentDateTime">Date</label>
          <div class="input-group date">
            <input type="text" class="form-control selector"  id="appointmentDateTime">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveAppointmentBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    var selectedDate = "";
    var events = @json($events);
    // var selectedDate;
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar:{
        start :'listMonth,dayGridMonth,timeGridWeek,timeGridDay',
        center: 'title',
        end:'today prev,next'
      },
      events: events,
      selectable: true,
      eventInteractive:true,
      select: function(start, end, allDays){
      $('#appointmentModal').modal('toggle');
      
      $selectedDate = moment(start.startStr).format('YYYY-MM-DD');
      
      //initialise Datepicker
      $(".selector").flatpickr({
      dateFormat: "Y-m-d H:i",
      enableTime:true,
      minTime: "09:00",
      time_24hr: true,
      defaultDate: $selectedDate
    });

      $('#saveAppointmentBtn').click(function(){
        var clientName = $('#client_name').val();
        var appointmentDateTime = $('#appointmentDateTime').val();
        var appointmentDateTime = moment(appointmentDateTime).format("YYYY-MM-DD HH:mm:ss")

        $.ajax({
          url: "{{ route('appointment.create') }}",
          type: "POST",
          dataType:'json',
          data: {
                  clientName: clientName,
                  appointmentDateTime: appointmentDateTime
          },

          headers: {
          'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
          },
          success:function(response){
            console.log(response);
            location.reload();

            // $('#calendar').fullCalendar('renderEvent',{
            //   'title': 'Appointment with: '.$response.client,
            // });
            
            // 
            
            

            $('#appointmentModal').modal('hide');


          },
          error:function(error){
            console.error(error);

          }
          




        });

      })

    
      
      
      }



    });
    calendar.render();





   
  });


  

 

</script>



</x-layout>






