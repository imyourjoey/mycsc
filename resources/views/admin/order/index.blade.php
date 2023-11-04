<x-layout>
    <x-navbar/>
      <div class="container-fluid">
          <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">Orders</div>
      
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
                                return 'Order Information'
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
                    url: '{{ route('admin.order.index') }}',
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
                buttons: [ 'excel',
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
                buttons: [ 'selectAll', 'selectNone' ]
                },   
                {
                extend: 'searchBuilder',
                config:
                    {
                        depthLimit:2,
                        columns: [1,2,3,4,5,12]
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
                window.location =  "{{ route('admin.order.create') }}" ;
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
                                window.location = "{{ route('admin.order.edit', ['order' => ':orderID']) }}".replace(':orderID', selectedData.orderID);
                                
    
                    }
                }
                },
                {
                extend: 'selected', // Bind to Selected row
                text: 'Delete',
                action: function (e, dt, button, config) {
            var selectedIds = table.rows({selected: true}).ids().toArray();
            
    
    
            if (selectedIds.length === 0) {
                alert('No records selected for deletion.');
                return;
            }
    
            if (confirm('Are you sure you want to delete the selected records?')) {
                $.ajax({
                    url: "{{ route('admin.order.destroy') }}",
                    type: "DELETE",
                    data: { selectedIds: selectedIds },
                    headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function (response) {
                        toastr.success('Selected record(s) have been deleted successfully')
                        table.ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        alert('Error deleting records: ' + xhr.responseText);
                    }
                });
            }
        }
                },


                {
                extend: 'selectedSingle', // Bind to Selected row
                text: 'OTP',
                action: function (e, dt, button, config) {
        var selectedData = table.row({ selected: true }).data();

        if (selectedData) {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.order.sendOTP') }}",
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                data: { selectedOrderIDs: selectedData.orderID },
                success: function (response) {
                    // Handle success - display message or perform necessary actions
                    toastr.success('OTP sent successfully!');
                    

                },
                error: function (xhr, status, error) {
                    // Handle errors
                    alert('Error sending OTP: ' + xhr.responseText);
                }
            });
        }
    }
                },
                {
    extend: 'selectedSingle', // Bind to Selected row
    text: 'Authenticate',
    action: function (e, dt, button, config) {
        // Get the selected data
        var selectedData = table.row({ selected: true }).data();

        if (selectedData) {
            // Assuming the authentication function is 'verifyAuthentication'
            var inputOTP = prompt('Please enter your OTP:');
            
            if (inputOTP !== null) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.order.authenticate') }}",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    data: {
                        selectedOrderID: selectedData.orderID,
                        enteredOTP: inputOTP
                    },
                    success: function (response) {
                        // Handle success - display message or perform necessary actions
                        if (response.success) {
                            toastr.success('Authentication successful!');
                            table.ajax.reload();
                        } else {
                            toastr.error('Invalid OTP, Please try again!');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        alert('Error verifying OTP: ' + xhr.responseText);
                    }
                });
            }
        }
    }
}

                
                
            ],
    
    
            columnDefs:
            [{
                targets:-1,
                orderable:false,
                className: 'dtr-control arrow-right',
               
            },
            {
            targets: [1,2,3,4,5,6,7,8,9,10,11,12,13],
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
                var date = new Date(data);
                var monthAbbreviation = date.toLocaleString("en-GB", { month: 'short' });
                var formattedDate = date.getDate() + ' ' + monthAbbreviation + '. ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                return formattedDate;
            }},
            { data: 'updated_at', 
              name: 'updated_at' , 
              className:'none',
              render: function (data) {
                var date = new Date(data);
                var monthAbbreviation = date.toLocaleString("en-GB", { month: 'short' });
                var formattedDate = date.getDate() + ' ' + monthAbbreviation + '. ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                return formattedDate;
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
  
    
    
    