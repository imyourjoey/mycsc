<x-layout>
  <x-navbar/>
    <div class="container-fluid">
        <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">Services</div>
    
      <div style="margin-top: 1rem"></div>
      <table class="display cell-border" id="services-table" style="width: 100%;">
          <thead>
              <tr>
                  <th style="max-width: 20px"></th>
                  <th class="colvis">ID</th>
                  <th class="colvis">Title</th>
                  <th class="colvis">Description</th>
                  <th>Image</th>
                  <th class="colvis" style="max-width: 75px">Estimated Duration</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th style="max-width: 40px"></th>
              </tr>
          </thead>
      </table>
    </div>
  
  
  
  
  </x-layout>
  
  
  
  {{-- Initialise Datatable --}}
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
                      target: -1,
                      display: $.fn.dataTable.Responsive.display.modal({
                          header: function (row) 
                          {
                              var data = row.data();
                              return 'Service Information ';
                          }
                      }),
                  renderer: DataTable.Responsive.renderer.tableAll()
                  },
              },
              select: 
              {
                  style: 'single', // Allow multi-row selection
                  selector: 'td:first-child'
              },
              ajax: 
              {
                  url: '{{ route('technician.service.index') }}',
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
                  columns:'th.colvis',
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
                      columns: [1,2,3,5]
                  }
              },
              {
                  extend: 'spacer',
                  style: 'bar',
                  text: 'Actions:'
              },
              // {
              // text: 'Add',
              // action: function ( e, dt, button, config ) {
              // window.location =  "{{ route('technician.service.create') }}" ;
              // }
              // },
              {
              extend: 'selectedSingle', // Bind to Selected row
              text: 'Edit',
              name: 'edit',
              action: function (e, dt, button, config) {
                          // Get the selected data
                  var selectedData = table.row({ selected: true }).data();
  
                  if (selectedData) {
                              // Redirect to the user details page with the selected user's ID
                              window.location = "{{ route('technician.service.edit', ['service' => ':serviceID']) }}".replace(':serviceID', selectedData.serviceID);
                              console.log('selectedData.serviceID')
  
                  }
              }
              },
          ],
  
  
          columnDefs:
          [{
              targets:-1,
              orderable:true,
              className: 'dtr-control arrow-right',
             
          }],
          columns: 
          [{
              targets:0,
              data: null,
              defaultContent: '',
              orderable: false, 
              className: 'select-checkbox'
          },
          { data: 'serviceID', name: 'serviceID' ,className:'all'},
          { data: 'serviceName', name: 'serviceName' },
          { data: 'serviceDesc', name: 'serviceDesc' },
          { data: 'servicePic', name: 'servicePic', className:'none',
            render: function(data, type, row) {
            // 'data' here represents the URL of the image
            // 'type' indicates the rendering type (e.g., 'display', 'filter', 'sort')
            if (type === 'display') {
            // Display the image as an <img> element
            var imageUrl = '{{ asset('storage/') }}' + '/' + data;
            return '<img src="' + imageUrl + '" alt="Image not available" style="max-width: 100px; max-height: 100px;" />';
            } else {
            // For other types, return the raw data
            return data;
            }



        }},
          { data: 'serviceEstDuration', 
            name: 'serviceEstDuration',
            render: function (data, type, row) {
            // Check if the rendering is for display (type === 'display')
            if (type === 'display') {
            // Assuming 'data' is the number of days, you can format it as desired
            return data + ' days';
            }
            // For other types (sorting, filtering, etc.), return the raw data
            return data;
            }},
          { data: 'created_at', 
            name: 'created_at', 
            className:'none', 
            render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }},
          { data: 'updated_at',
            name: 'updated_at' ,
            className:'none',
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

  
  
  