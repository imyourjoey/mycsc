<x-layout>
  <style>
    .fc-event-time, .fc-event-title {
padding: 0 1px;
white-space: normal;
}
.fc-event{
    cursor: pointer;
}

.close {
  font-size: 15px; 
  margin-top: none;
}
  </style>
<x-navbar/>


  <div class="container-fluid">
    <div class="h1 ml-3 mt-4 font-weight-bold">Appointments</div>

      <div class="row-fluid">
          <div class="col-lg-12 mt-4 mb-5">
              <div id='calendar'></div>
          </div>
      </div>
  </div>

  
  <div class="modal hide" id="appointmentModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 50%" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
          </button>

          <div class="container mt-4">
            <div class="form-group h3">Appointment Details</div>
            <div class="row">
              <div class="col-6">
                Client Name:
              </div>
              <div class="col-6 client-name">
                
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Date & Time:
              </div>
              <div class="col-6 date-time">
                
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Remarks:
              </div>
              <div class="col-6 remarks">
                
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                Status:
              </div>
              <div class="col-6 status">
                
              </div>
            </div>

            </div>


          </div>

          <div class="modal-footer container d-inline">
            <div class="row">
              <div class="col-6">
                <p class="d-inline ml-3 mr-2">Actions:</p>
                <a href="" id="editLink" class="link-dark">Edit <i class="fas fa-edit fa-lg"></i></a>
                <a href="#" id="deleteAppointments" class="link-dark">Delete <i class="fas fa-trash fa-lg"></i></a>
              </div>
          </div>
          {{-- <div class="form-group">
            <label for="client_name">Client Name</label>
            <select class="form-control selectpicker" id="client_name" data-live-search="true">
              @foreach ($clients as $client)
              <option>{{ $client->name }}</option>
            @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="appointmentDateTime">Date</label>
            <div class="input-group date">
              <input type="text" class="form-control selector border"  id="appointmentDateTime">
            </div>
          </div> --}}
        </div>
        
        

        
      </div>
    </div>
  </div>
  

  


  
</x-layout>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var appointmentId = '';
    // $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    // var selectedDate = "";
    var events = @json($events);
    // var selectedDate;
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      validRange: function(nowDate) {
    return {
      start: nowDate
    };
    },
      headerToolbar:{
        start :'listMonth dayGridMonth,timeGridWeek,timeGridDay',
        center: 'title',
        end:'today prev,next'
      },
      events: events,
      eventDisplay: 'block',
      displayEventTime: true,
      displayEventEnd:true,
      selectable: true,
      eventInteractive:true,
      eventClick: function(event){
        appointmentId = event.event._def.publicId;

        var url = "{{ route('appointment.show', ['id' => ':id']) }}";
        url = url.replace(':id', appointmentId);

        var editUrl = "{{ route('appointment.edit', ['appointment' => ':id']) }}";
        editUrl = editUrl.replace(':id', appointmentId);

        // Update the href attribute of the edit link
        $('#editLink').attr('href', editUrl);

        console.log(url);
        $.ajax({
    url: url, // Constructed URL with appointmentId
    type: "GET",
    dataType: 'json',
    data : {id:appointmentId},
    success: function(response) {
      // Update the modal content with appointment details
      $('#appointmentModal .modal-body .client-name').text(response.clientName);
      $('#appointmentModal .modal-body .date-time').text(response.dateTime);
      $('#appointmentModal .modal-body .remarks').text(response.remarks);
      $('#appointmentModal .modal-body .status').text(response.status.charAt(0).toUpperCase() + response.status.slice(1));
      // Show the modal
      $('#appointmentModal').modal('show');
    },
    error: function(error) {
      console.error(error);
    }
  });

        $('#appointmentModal').modal('show');

      
      //   $.ajax({
      //   url: "{{ route('appointment.index') }}",  
      //   type: "GET",
      //   dataType: 'json',
      //   data: { id: appointmentId },
      //   headers: {
      //             'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
      //     },
      //   success: function(response) {
      //     // Update the modal content with appointment details
      //     $('#appointmentModal .modal-body .client-name').text(response.clientName);
      //     $('#appointmentModal .modal-body .date-time').text(response.dateTime);
      //     $('#appointmentModal .modal-body .remarks').text(response.remarks);
      //     $('#appointmentModal .modal-body .status').text(response.status);

      //     // Show the modal
      //     $('#appointmentModal').modal('show');
      //   },
      //   error: function(error) {
      //     console.error(error);
      //   }
      // });

      },
      // eventClick: function(event){
      //   $('#appointmentModal').modal('toggle');
      // if (confirm('Are you sure you want to delete the selected records?')) {
      //   var id = event.event._def.publicId;

      //   $.ajax({
      //     url: "{{ route('calendar.destroy') }}",
      //     type: "DELETE",
      //     dataType:'json',
      //     data: {id:id},
      //     headers: {
      //             'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
      //     },
      //     success: function (response) {
      //             toastr.success('Selected record(s) have been deleted successfully');
                  
      //             },
      //             error: function (xhr, status, error) {
      //             alert('Error deleting records: ' + xhr.responseText);
      //             }

      //   });
      //   location.reload();
      // }
        

        

      // },
      select: function(start, end, allDays){
        var selectedDate = moment(start.startStr).format('YYYY-MM-DD');
        window.location.href = "{{ route('appointment.create', ['date' => '']) }}" + selectedDate;

    }
    //   select: function(start, end, allDays){
    //   $('#appointmentModal').modal('toggle');
      
    //   $selectedDate = moment(start.startStr).format('YYYY-MM-DD');
      
    //   //initialise Datepicker
    //   $(".selector").flatpickr({
    //   dateFormat: "Y-m-d H:i",
    //   enableTime:true,
    //   minTime: "09:00",
    //   time_24hr: true,
    //   defaultDate: $selectedDate
    // });



    

    //   // $('#saveAppointmentBtn').click(function(){
    //   //   var clientName = $('#client_name').val();
    //   //   var appointmentDateTime = $('#appointmentDateTime').val();
    //   //   var appointmentDateTime = moment(appointmentDateTime).format("YYYY-MM-DD HH:mm:ss");
    //   function saveAppointment() {
    //     var clientName = $('#client_name').val();
    //     var appointmentDateTime = $('#appointmentDateTime').val();
    //     var appointmentDateTime = moment(appointmentDateTime).format("YYYY-MM-DD HH:mm:ss");

    //     $.ajax({
    //       url: "{{ route('appointment.create') }}",
    //       type: "POST",
    //       dataType:'json',
    //       data: {
    //               clientName: clientName,
    //               appointmentDateTime: appointmentDateTime
    //       },

    //       headers: {
    //       'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
    //       },
    //       success:function(response){
    //         console.log(response);
    //         location.reload();

    //         // $('#calendar').fullCalendar('renderEvent',{
    //         //   'title': 'Appointment with: '.$response.client,
    //         // });
            
    //         // 
            
            

    //         $('#appointmentModal').modal('hide');


    //       },
    //       error:function(error){
    //         console.error(error);

    //       }
          




    //     });

    //   }


      

    //   $('#saveAppointmentBtn').off('click').on('click', saveAppointment);

      
      
    //   }


    



    });
    calendar.render();


    $('#deleteAppointments').on('click', function (e) {
      e.preventDefault();
      var id = appointmentId;
      


    if (appointmentId.length === 0) {
        alert('No appointments selected for deletion.');
        return;
    }

    if (confirm('Are you sure you want to delete the selected appointments?')) {
     console.log(id);

        $.ajax({
            url: "{{ route('appointment.destroy') }}", // Change this route to the appropriate Appointment destroy route
            type: "DELETE",
            data: { id: id },
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
            },
            dataType: 'json',
            success: function (response) {
                toastr.success('Selected appointments have been deleted successfully');
                location.reload();
                // Remove the selected appointments from FullCalendar
            },
            error: function (xhr, status, error) {
                alert('Error deleting appointments: ' + xhr.responseText);
            }
        });
    }
});








   
  });


  

 

</script>


<script>
  $(document).ready(function() {


  });
  </script>
