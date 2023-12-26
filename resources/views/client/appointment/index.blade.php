<x-layout>

    <style>
        .statusApproved div{
            background-color: #28a745;
            color: white;
            font-weight: 600;
            border-radius: 25px; /* Adjust the border-radius to control the capsule shape */
            padding: 5px 15px; /* Adjust padding as needed */
            display: inline-block; /* Ensures that the background color only covers the content */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .statusPending div{
            background-color: #f57c02;
            color: white;
            font-weight: 600;
            border-radius: 25px; /* Adjust the border-radius to control the capsule shape */
            padding: 5px 15px; /* Adjust padding as needed */
            display: inline-block; /* Ensures that the background color only covers the content */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        
    </style>

  <x-navbar />
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="h2 mt-4 font-weight-bold">My Appointments</div>

        <table class="display cell-border" id="client-appointments-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="max-width: 20px"></th>
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


    <div class="row">
      <div class="col-8">
        <div class="h2 mt-5 mb-2 font-weight-bold">Request Appointment</div>

        <form method="POST" action={{ route('client.appointment.store') }} id="requestAppointmentForm" enctype="multipart/form-data">
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
                  <button type="submit" class="btn btn-primary btn-block">Request <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
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
              url: '{{ route('client.appointment.index') }}',
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
              {
                    extend: 'spacer',
                    text: 'Action:'
              },
              {
                  extend: 'selected',
                  text: 'Delete',
                  action: function (e, dt, button, config) {
            var selectedIds = table.rows({selected: true}).ids().toArray();
            
    
    
            if (selectedIds.length === 0) {
                alert('No records selected for deletion.');
                return;
            }
    
            if (confirm('Are you sure you want to delete the selected records?')) {
                $.ajax({
                    url: "{{ route('client.appointment.destroy') }}",
                    type: "DELETE",
                    data: { selectedIds: selectedIds },
                    headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function (response) {
                        //alert(response.message);
                        toastr.success('Selected record(s) have been deleted successfully')
                        // You can reload the DataTable or update it as needed.
                        table.ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Error deleting records: ' + xhr.responseText);
                    }
                });
            }
        }
              },
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
              {
                targets:0,
                data: null,
                defaultContent: '',
                orderable: false, 
                className: 'select-checkbox'
              },
              { data: 'appointmentID', name: 'appointmentID' },
              { data: 'appointmentDateTime', 
                name: 'appointmentDateTime',
                render: function (data) {
                var date = new Date(data);
                var monthAbbreviation = date.toLocaleString("en-GB", { month: 'short' });
                var formattedDate = date.getDate() + ' ' + monthAbbreviation + '. ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                return formattedDate;
            } },
              { data: 'appointmentStatus', 
                name: 'appointmentStatus',
                render: function (data) {
 
                // Wrap the content in a div with the appropriate class
                return '<div>' + data.charAt(0).toUpperCase() + data.slice(1) + '</div>';
            }
              },
              { data: 'remarks', name: 'remarks' },
              {
                  data: null,
                  defaultContent: '',
                  orderable: false,
                  className: 'text-center'
              }
          ],
          rowCallback: function(row, data, index) {
            if (data.appointmentStatus == "pending") {
            $("td:eq(3)", row).addClass("statusPending");
            }

            if (data.appointmentStatus == "approved") {
            $("td:eq(3)", row).addClass("statusApproved");
            }
    }
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

