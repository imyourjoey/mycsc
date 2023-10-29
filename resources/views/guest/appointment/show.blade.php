<x-layout>

  <x-navbar />
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="h2 mt-4 font-weight-bold">Appointments</div>
        <div class="h6 font-weight-bold">Requested with email: {{ $email }} </div>


        <table class="display cell-border" id="client-appointments-table" style="width: 100%;">
            <thead>
                <tr>
                    {{-- <th style="max-width: 20px"></th> --}}
                    <th class="colvis">ID</th>
                    <th class="colvis">Date & Time</th>
                    <th class="colvis">Status</th>
                    <th>Remarks</th>
                    <th style="max-width: 40px"></th>
                </tr>
            </thead>
        </table>
      </div>
    </div>


  </div>
</x-layout>

{{-- Initialize DataTable --}}
<script>
  $(function () {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      var table = $('#client-appointments-table').DataTable({
        rowId: 'appointmentID',
          // language: {
          //     searchBuilder: {
          //         button: 'Filter'
          //     },
          //     buttons: {
          //         savedStates: {
          //             0: 'Saved States',
          //             _: 'Saved States (%d)'
          //         }
          //     }
          // },
          serverSide: false,
          processing: true,
          pagingType: "simple_numbers",
          responsive: {
              details: {
                  type: 'column',
                  target: -1,
                  display: $.fn.dataTable.Responsive.display.modal({
                      header: function (row) {
                          var data = row.data();
                          return 'Details of ' + data.appointmentID;
                      }
                  }),
                  renderer: DataTable.Responsive.renderer.tableAll()
              },
          },
          select: 
                {
                    style: 'multi', // Allow multi-row selection
                    selector: 'td:first-child'
                },
          ajax: {
              url: '{{ route('showGuestAppointment') }}',
              type: 'GET'
          },
          dom: 'Bfrtip',
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          buttons: [
              // 'pageLength',
              // {
              //     extend: 'colvis',
              //     text: 'Show/Hide',
              //     columns: 'th.colvis',
              //     columnText: function (dt, idx, title) {
              //         if (idx == 0) {
              //             return 'Checkbox';
              //         } else {
              //             return title;
              //         }
              //     }
              // },
              // {
              //     extend: 'collection',
              //     text: 'Export',
              //     buttons: ['excel', {
              //         extend: 'pdfHtml5',
              //         orientation: 'landscape',
              //         pageSize: 'LEGAL'
              //     }]
              // },
              // {
              //     extend: 'collection',
              //     text: 'Select',
              //     buttons: ['selectAll', 'selectNone']
              // },
              // {
              //     extend: 'searchBuilder',
              //     config: {
              //         depthLimit: 2,
              //         columns: [0, 1, 2, 3, 4, 5]
              //     }
              // },
        //       {
        //             extend: 'spacer',
        //             text: 'Action:'
        //       },
        //       {
        //           extend: 'selected',
        //           text: 'Delete',
        //           action: function (e, dt, button, config) {
        //     var selectedIds = table.rows({selected: true}).ids().toArray();
            
    
    
        //     if (selectedIds.length === 0) {
        //         alert('No records selected for deletion.');
        //         return;
        //     }
    
        //     if (confirm('Are you sure you want to delete the selected records?')) {
        //         $.ajax({
        //             url: "{{ route('client.appointment.destroy') }}",
        //             type: "DELETE",
        //             data: { selectedIds: selectedIds },
        //             headers: {
        //             'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
        //             },
        //             success: function (response) {
        //                 //alert(response.message);
        //                 toastr.success('Selected record(s) have been deleted successfully')
        //                 // You can reload the DataTable or update it as needed.
        //                 table.ajax.reload();
        //             },
        //             error: function (xhr, status, error) {
        //                 alert('Error deleting records: ' + xhr.responseText);
        //             }
        //         });
        //     }
        // }
        //       },
          ],
          columnDefs:
            [{
                targets:-1,
                orderable:false,
                className: 'dtr-control arrow-right',
               
            },
            {
            targets: [1,2,3,4],
            defaultContent:"N/A"
          }],
          columns: [
              // {
              //   targets:0,
              //   data: null,
              //   defaultContent: '',
              //   orderable: false, 
              //   className: 'select-checkbox'
              // },
              { data: 'appointmentID', name: 'appointmentID' },
              { data: 'appointmentDateTime', 
                name: 'appointmentDateTime',
                render: function (data) {
                var date = new Date(data);
                var monthAbbreviation = date.toLocaleString("en-GB", { month: 'short' });
                var formattedDate = date.getDate() + ' ' + monthAbbreviation + '. ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                return formattedDate;
            } },
              { data: 'appointmentStatus', name: 'appointmentStatus' },
              { data: 'remarks', name: 'remarks' },
              {
                  data: null,
                  defaultContent: '',
                  orderable: false,
                  className: 'text-center'
              }
          ]
      });
  });
</script>

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

{{-- <script>
  $(document).ready(function () {
      $("#createAppointmentBtn").click(function () {
          // Get form data
          var formData = $("#requestAppointmentForm").serialize();

          // Send AJAX request
          $.ajax({
              type: "POST",
              url: "{{ route('client.appointment.store') }}", // Replace with the actual route for creating an appointment
              data: formData,
              success: function (response) {
                  // Handle success (e.g., show a success message)
                  alert("Appointment created successfully!");
                  // You can also redirect the user or perform other actions as needed.
              },
              error: function (xhr, status, error) {
                  // Handle errors (e.g., show an error message)
                  alert("Error creating appointment: " + xhr.responseText);
              }
          });
      });
  });
</script> --}}

