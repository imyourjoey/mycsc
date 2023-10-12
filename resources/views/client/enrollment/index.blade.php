<x-layout>
  <x-navbar/>
  <div class="container-fluid">
      

    <div class=" h2 pt-4 mb-4 font-weight-bold">My Enrollments</div>
      <div class="row">
        <div class="col-12">
        <table class="display cell-border" id="client-enrollments-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="max-width: 20px"></th>
                    <th class="colvis">ID</th>
                    <th class="colvis">Title</th>
                    <th class="colvis">Description</th>
                    <th class="colvis">Starting Date & Time</th>
                    <th class="colvis">Ending Date & Time</th>
                    <th class="colvis">Venue</th>
                    <th class="colvis">Instructor</th>
                    <th class="colvis">Status</th>
                    <th style="max-width: 40px"></th>
                </tr>
            </thead>
        </table>
        </div>
      </div>


      {{-- enrol training program --}}
      <div class="h2 pt-4 mb-4 font-weight-bold">Enroll Training Program</div>
      <div class="row">
        <div class="col-12">
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

                                <div>
                                    <form method="POST" action={{ route('client.enrollment.store') }} id="trainingEnrollmentForm" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="trainingID" value="{{$training->trainingID }}">
                              
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <button type="submit" class="mt-3 btn btn-primary">Enrol <i class="fa fa-arrow-right"
                                                        aria-hidden="true"></i></button>
                              
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                
                                
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      </div>
    



    {{-- enroll training program --}}
    {{-- <div class="row">
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
    </div> --}}
  </div>
  
  
</x-layout>

{{-- Initialize DataTable --}}
<script>
    $(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var table = $('#client-enrollments-table').DataTable({
          rowId: 'enrollmentID',
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
                            return 'Details of ' + data.enrollmentID;
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
                url: '{{ route('client.enrollment.index') }}',
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
                      url: "{{ route('client.enrollment.destroy') }}",
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
                 
              }],
            columns: [
                {
                  targets:0,
                  data: null,
                  defaultContent: '',
                  orderable: false, 
                  className: 'select-checkbox'
                },
                { data: 'enrollmentID', name: 'enrollmentID' },
                { data: 'trainingTitle', name: 'trainingTitle' },
                { data: 'trainingDesc', name: 'trainingDesc' },
                { data: 'startDateTime', name: 'startDateTime' },
                { data: 'endDateTime', name: 'endDateTime' },
                { data: 'trainingVenue', name: 'trainingVenue' },
                { data: 'trainerName', name: 'trainerName' },
                { data: 'enrollStatus', name: 'enrollStatus' },


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


