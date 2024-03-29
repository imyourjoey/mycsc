<x-layout>
  <x-navbar/>

  <div class="container-fluid">
      <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">Trainings</div>

      <div style="margin-top: 1rem"></div>
      <table class="display cell-border" id="training-table" style="width: 100%;">
          <thead>
              <tr>
                  <th style="max-width: 20px"></th>
                  <th class="colvis">ID</th>
                  <th class="colvis">Title</th>
                  <th class="colvis">Capacity</th>
                  <th class="colvis">Venue</th>
                  <th class="colvis">Description</th>
                  <th class="colvis">Trainer Name</th>
                  <th class="colvis">Added By</th>
                  <th class="colvis">Start Date/Time</th>
                  <th class="colvis">End Date/Time</th>
                  <th class="colvis">Registration Deadline</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th style="max-width: 40px"></th>
              </tr>
          </thead>
      </table>
  </div>
</x-layout>

<!-- Initialize DataTable for Training -->
<script>
  $(function () {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      var table = $('#training-table').DataTable({
          rowId: 'trainingID',
          language: {
              searchBuilder: {
                  button: 'Filter'
              },
              buttons: {
                  savedStates: {
                      0: 'Saved States',
                      _: 'Saved States (%d)'
                  }
              }
          },
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
                          return 'Training Details';
                      }
                  }),
                  renderer: DataTable.Responsive.renderer.tableAll()
              },
          },
          select: {
              style: 'multi', // Allow multi-row selection
              selector: 'td:first-child'
          },
          ajax: {
              url: '{{ route('admin.training.index') }}', // Change this route to the appropriate Training index route
              type: 'GET'
          },
          dom: 'Bfrtip', // Specify the buttons to display
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], // Options for the length menu
          buttons: [
              {
                  extend: 'spacer',
                  text: 'Table Control:'
              },
              'pageLength',
              {
                  extend: 'savedStatesCreate',
                  config: {
                      splitSecondaries: [
                          'renameState',
                          'removeState',
                          ''
                      ]
                  }
              },
              {
                  extend: 'colvis',
                  text: 'Show/Hide',
                  columns: 'th.colvis',
                  columnText: function (dt, idx, title) {
                      if (idx == 0) {
                          return 'Checkbox';
                      } else {
                          return title;
                      }
                  }
              },
              {
                  extend: 'collection',
                  text: 'Export',
                  buttons: ['excel',
                      {
                          extend: 'pdfHtml5',
                          orientation: 'landscape',
                          pageSize: 'LEGAL'
                      }
                  ]
              },
              {
                  extend: 'collection',
                  text: 'Select',
                  buttons: ['selectAll', 'selectNone']
              },
              {
                  extend: 'searchBuilder',
                  config: {
                      depthLimit: 2,
                      columns: [1, 2, 3, 6, 7, 8, 9, 10]
                  }
              },
              {
                  extend: 'spacer',
                  style: 'bar',
                  text: 'Actions:'
              },
              {
                  text: 'Add',
                  action: function (e, dt, button, config) {
                      window.location = "{{ route('admin.training.create') }}"; // Change this route to the appropriate Training create route
                  }
              },
              {
                  extend: 'selectedSingle', // Bind to Selected row
                  text: 'Edit',
                  name: 'edit',
                  action: function (e, dt, button, config) {
                      var selectedData = table.row({ selected: true }).data();
                      if (selectedData) {
                          window.location = "{{ route('admin.training.edit', ['training' => ':trainingID']) }}".replace(':trainingID', selectedData.trainingID); // Change this route to the appropriate Training edit route
                      }
                  }
              },
              {
                  extend: 'selected', // Bind to Selected row
                  text: 'Delete',
                  action: function (e, dt, button, config) {
                      var selectedIds = table.rows({ selected: true }).ids().toArray();
                      if (selectedIds.length === 0) {
                          alert('No records selected for deletion.');
                          return;
                      }
                      if (confirm('Are you sure you want to delete the selected records?')) {
                          $.ajax({
                              url: "{{ route('admin.training.destroy') }}", // Change this route to the appropriate Training destroy route
                              type: "DELETE",
                              data: { selectedIds: selectedIds },
                              headers: {
                                  'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                              },
                              success: function (response) {
                                  toastr.success('Selected record(s) have been deleted successfully');
                                  table.ajax.reload();
                              },
                              error: function (xhr, status, error) {
                                  alert('Error deleting records: ' + xhr.responseText);
                              }
                          });
                      }
                  }
              }
          ],
          columnDefs: [
              {
                  targets: -1,
                  orderable: false,
                  className: 'dtr-control arrow-right',
              }
          ],
          columns: [
              {
                  targets: 0,
                  data: null,
                  defaultContent: '',
                  orderable: false,
                  className: 'select-checkbox'
              },
              { data: 'trainingID', name: 'trainingID' },
              { data: 'trainingTitle', name: 'trainingTitle' },
              { data: 'trainingCapacity', name: 'trainingCapacity' },
              { data: 'trainingVenue', name: 'trainingVenue' },
              { data: 'trainingDesc', name: 'trainingDesc' },
              { data: 'trainerName', name: 'trainerName' },
              { data: 'adminName', name: 'adminName' },
              { data: 'startDateTime', 
                name: 'startDateTime',
                render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }
              },
              { data: 'endDateTime',
                name: 'endDateTime',
                render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }
              },
              { data: 'regisDeadline',
                name: 'regisDeadline',
                render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }
              },
              {
                  data: 'created_at',
                  name: 'created_at',
                  className: 'none',
                  render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }},
              {
                  data: 'updated_at',
                  name: 'updated_at',
                  className: 'none',
                  render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }},
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
