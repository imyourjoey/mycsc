<x-layout>
  <x-navbar/>
    <div class="container-fluid">
        <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">Services</div>
    
      <div style="margin-top: 1rem"></div>
      <table class="display cell-border" id="services-table" style="width: 100%;">
          <thead>
              <tr>
                  <th></th>
                  <th></th>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Picture</th>
                  <th>Estimated Duration<br>(in Days)</th>
                  <th>Created At</th>
                  <th>Updated At</th>
              </tr>
          </thead>
      </table>
    </div>
  
  
  
  
  </x-layout>
  
  
  
  Initialise Datatable
  <script>
      $(function () {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
          var table = $('#services-table').DataTable({
              rowId: 'serviceID',
              language: 
              {
                  searchBuilder: 
                  {
                      button: 'Filter'
                  
                  },
              
                  buttons:
                  {
                      savedStates: 
                      {
                          0: 'Saved States',
                          _: 'Saved States (%d)'
                      }
                  }
  
              },
              serverSide: false,
              processing: true,
              pagingType: "simple_numbers",
              responsive:
              {
                  details:
                  {
                      type:'column',
                      target: 1,
                      display: $.fn.dataTable.Responsive.display.modal({
                          header: function (row) 
                          {
                              var data = row.data();
                              return 'Details of ' + data.name;
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
              ajax: 
              {
                  url: '{{ route('service.index') }}',
                  type: 'GET'
  
              },
              dom: 'Bfrtip', // Specify the buttons to display
              lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], // Options for the length menu
  
              buttons: 
              [{
                  extend: 'spacer',
                  text: 'Table Control:'
              },
  
              'pageLength',
              {
                  extend: 'savedStatesCreate',
                  config: 
                  {
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
                  columns:':not(:eq(1))',
                  columnText: function ( dt, idx, title ) 
                  {
                      if(idx == 0 ){
                          return 'Checkbox';
                      }else{
                          return title;
                      }
                  }
              },
              {
              extend: 'collection',
              text: 'Export',
              buttons: [ 'excel', 'pdf' ]
              },
              {
              extend: 'collection',
              text: 'Select',
              buttons: [ 'selectAll', 'selectNone' ]
              },   
              {
              extend: 'searchBuilder',
              config:
                  {
                      depthLimit:2,
                      columns: [1,2,3,4,5]
                  }
              },
              {
                  extend: 'spacer',
                  style: 'bar',
                  text: 'Actions:'
              },
              {
              text: 'Add',
              action: function ( e, dt, button, config ) {
              window.location =  "{{ route('service.create') }}" ;
              }
              },
              {
              extend: 'selectedSingle', // Bind to Selected row
              text: 'Edit',
              name: 'edit',
              action: function (e, dt, button, config) {
                          // Get the selected data
                  var selectedData = table.row({ selected: true }).data();
  
                  if (selectedData) {
                              // Redirect to the user details page with the selected user's ID
                              window.location = "{{ route('service.edit', ['service' => ':serviceID']) }}".replace(':serviceID', selectedData.serviceID);
                              console.log('selectedData.serviceID')
  
                  }
              }
              },
              {
              extend: 'selected', // Bind to Selected row
              text: 'Delete',
              action: function (e, dt, button, config) {
          // var selectedIds = dt.rows({ selected: true }).ids().toArray();
          // console.log(selectedIds);
          var selectedIds = table.rows({selected: true}).ids().toArray();
          console.log(selectedIds);
          
  
  
          if (selectedIds.length === 0) {
              alert('No records selected for deletion.');
              return;
          }
  
          if (confirm('Are you sure you want to delete the selected records?')) {
              $.ajax({
                  url: "{{ route('service.destroy') }}",
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
              }
              
              
          ],
  
  
          columnDefs:
          [{
              targets:1,
              orderable:false,
              className: 'dtr-control',
             
          }],
          columns: 
          [{
              targets:0,
              data: null,
              defaultContent: '',
              orderable: false, 
              className: 'select-checkbox'
          },
          {
              data:null,
              defaultContent: ''
          },
          { data: 'serviceID', name: 'serviceID' },
          { data: 'serviceName', name: 'serviceName' },
          { data: 'serviceDesc', name: 'serviceDesc' },
          { data: 'servicePic', name: 'servicePic' },
          { data: 'serviceEstDuration', name: 'serviceEstDuration' },
          { data: 'created_at', name: 'created_at',  render: function (data) {
              return new Date(data).toLocaleString("en-GB"); 
          }},
          { data: 'updated_at', name: 'updated_at' , render: function (data) {
              return new Date(data).toLocaleString("en-GB");}}
                        
          ]
          });
      });
  
  
      
  
  
  
      
  
  
      
  
  
  
      
  </script>

  
  
  