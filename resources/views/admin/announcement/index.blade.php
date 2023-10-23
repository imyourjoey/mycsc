<x-layout>
  <x-navbar/>

  <div class="container-fluid">
      <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">Announcements</div>

      <div style="margin-top: 1rem"></div>
      <table class="display cell-border" id="announcement-table" style="width: 100%;">
          <thead>
              <tr>
                  <th style="max-width: 20px"></th>
                  <th class="colvis">ID</th>
                  <th class="colvis">Title</th>
                  <th class="colvis">Content</th>
                  <th class="colvis">Added By</th>
                  <th>Picture</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th style="max-width: 40px"></th>
              </tr>
          </thead>
      </table>
  </div>
</x-layout>

<!-- Initialize DataTable for Announcement -->
<script>
  $(function () {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      var table = $('#announcement-table').DataTable({
          rowId: 'announcementID',
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
                        //   return 'Details of ' + data.announcementID;
                            return 'Announcement Information';

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
              url: '{{ route('admin.announcement.index') }}', // Change this route to the appropriate Announcement index route
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
                      columns: [1, 2, 4]
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
                      window.location = "{{ route('admin.announcement.create') }}"; // Change this route to the appropriate Announcement create route
                  }
              },
              {
                  extend: 'selectedSingle', // Bind to Selected row
                  text: 'Edit',
                  name: 'edit',
                  action: function (e, dt, button, config) {
                      var selectedData = table.row({ selected: true }).data();
                      if (selectedData) {
                          window.location = "{{ route('admin.announcement.edit', ['announcement' => ':announcementID']) }}".replace(':announcementID', selectedData.announcementID); 
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
                              url: "{{ route('admin.announcement.destroy') }}", // Change this route to the appropriate Announcement destroy route
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
              { data: 'announcementID', name: 'announcementID' },
              { data: 'announcementTitle', name: 'announcementTitle' },
              { data: 'announcementContent', name: 'announcementContent' },
              { data: 'adminName', name: 'adminName' },
              { data: 'announcementPic', name: 'announcementPic' , className: 'none',
              render: function(data, type, row) {
            // 'data' here represents the URL of the image
            // 'type' indicates the rendering type (e.g., 'display', 'filter', 'sort')
            if (type === 'display') {
            // Display the image as an <img> element
            var imageUrl = '{{ asset('storage/') }}' + '/' + data;
            return '<img src="' + imageUrl + '" alt="Image not available" style="max-width: 405px; " />';
            } else {
            // For other types, return the raw data
            return data;
            }}
              },
              {
                  data: 'created_at',
                  name: 'created_at',
                  className: 'none',
                  render: function (data) {
                      return new Date(data).toLocaleString("en-GB");
                  }
              },
              {
                  data: 'updated_at',
                  name: 'updated_at',
                  className: 'none',
                  render: function (data) {
                      return new Date(data).toLocaleString("en-GB");
                  }
              },
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
