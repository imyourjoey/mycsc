<x-layout>
  <x-navbar/>
    <div class="container-fluid">
        <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">My Orders</div>
    
      <div style="margin-top: 1rem"></div>
      <table class="display cell-border" id="orders-table" style="width: 100%;">
          <thead>
              <tr>
                  <th style="max-width: 20px"></th>
                  <th class="colvis">ID</th>
                  <th class="colvis">Client Name</th>
                  <th class="colvis">Service Type</th>
                  <th class="colvis">Assigned Technician</th>
                  <th class="colvis">Device Type</th>
                  <th>Hardware<br>Manufacturer</th>
                  <th>Part No.</th>
                  <th>Serial No.</th>
                  <th class="colvis">Disk Capacity</th>
                  <th class="colvis">Capacity Restored</th>
                  <th>Others Included</th>
                  <th class="colvis">Order Status</th>
                  <th>Order Status Image</th>
                  <th>Order Remarks</th>
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
          var table = $('#orders-table').DataTable({
              rowId: 'orderID',
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
                              return 'Order Information ';
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
                  url: '{{ route('client.order.index') }}',
                  type: 'GET'
  
              },
              dom: 'frtip', // Specify the buttons to display
              lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], // Options for the length menu

          columnDefs:
          [{
              targets:-1,
              orderable:false,
              className: 'dtr-control arrow-right',
             
          },
          {
            targets: [1,2,3,4,5,6,7,8,9,10,11],
            defaultContent:"N/A"
          }],
          columns: 
          [{
              targets:0,
              data: null,
              defaultContent: '',
              orderable: false, 
              className: 'select-checkbox'
          },
          { data: 'orderID', name: 'orderID'},
          { data: 'clientName', name: 'clientName' },
          { data: 'serviceName', name: 'serviceName' },
          { data: 'assignedTechnician', name: 'assignedTechnician' },
          { data: 'deviceType', name: 'deviceType' },
          { data: 'hardwareManufacturer', name: 'hardwareManufacturer', className:'none' },
          { data: 'partNo', name: 'partNo', className:'none' },
          { data: 'serialNo', name: 'serialNo', className:'none'},
          { data: 'diskCapacity', name: 'diskCapacity' },
          { data: 'capacityRestored', name: 'capacityRestored' },
          { data: 'othersIncluded', name: 'othersIncluded', className:'none'},
          { data: 'orderStatus', name: 'orderStatus' },
          { data: 'orderStatusPic', name: 'orderStatusPic', className:'none',
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
      }           
          },
          { data: 'orderRemarks', name: 'orderRemarks', className:'none' },
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

  
  
  