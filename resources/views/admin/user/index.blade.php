<x-layout>

    <style>
        .roleTechnician div{
            background-color: #6c747e;
            color: white;
            font-weight: 600;
            border-radius: 15px; /* Adjust the border-radius to control the capsule shape */
            padding: 5px 15px; /* Adjust padding as needed */
            display: inline-block; /* Ensures that the background color only covers the content */
        }
    
        .roleAdmin div{
            background-color: #4285F4;
            color: #ffffff;
            font-weight: 600;
            border-radius: 15px; /* Adjust the border-radius to control the capsule shape */
            padding: 5px 15px; /* Adjust padding as needed */
            display: inline-block; /* Ensures that the background color only covers the content */
        }
    
        .roleClient div{
            background-color: #34A853;
            color: #ffffff;
            font-weight: 600;
            border-radius: 15px; /* Adjust the border-radius to control the capsule shape */
            padding: 5px 15px; /* Adjust padding as needed */
            display: inline-block; /* Ensures that the background color only covers the content */
        }
    </style>
<x-navbar/>



    <div class="container-fluid">
    <div class="h1 mt-4 mb-4 ml-2 font-weight-bold">Users</div>

    <div style="margin-top: 1rem"></div>
    <table class="display cell-border" id="users-table" style="width: 100%;">
        <thead>
            <tr>
                <th style="max-width:20px"></th>
                <th class="colvis">ID</th>
                <th class="colvis">Name</th>
                <th class="colvis">Email</th>
                <th class="colvis">Phone No.</th>
                <th class="colvis">Role</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th style="max-witdth:40px"></th>

            </tr>
        </thead>
    </table>
    </div>




</x-layout>



{{-- Initialise Datatable --}}
<script>
    $(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var table = $('#users-table').DataTable({
            rowId: 'id',
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
                            return 'User Information';
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
                url: '{{ route('admin.user.index') }}',
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
            window.location =  "{{ route('admin.user.create') }}" ;
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
                    console.log(selectedData.id);
                            // Redirect to the user details page with the selected user's ID
                            window.location = "{{ route('admin.user.edit', ['user' => ':id']) }}".replace(':id', selectedData.id);

                }
            }
            },
            {
            extend: 'selected', // Bind to Selected row
            text: 'Delete',
            action: function (e, dt, button, config) {
        var selectedIds = table.rows({selected: true}).ids().toArray();
        console.log(selectedIds);
        


        if (selectedIds.length === 0) {
            alert('No records selected for deletion.');
            return;
        }

        if (confirm('Are you sure you want to delete the selected records?')) {
            $.ajax({
                url: "{{ route('admin.user.destroy') }}",
                type: "DELETE",
                data: { selectedIds: selectedIds },
                headers: {
                'X-CSRF-TOKEN': csrfToken 
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
            }
            
            
        ],


        columnDefs:
        [{
            targets:-1,
            orderable:false,
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
        { data: 'userTag', name: 'userTag' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'phoneNo', name: 'phoneNo'},
        { data: 'role', 
          name: 'role',
          render: function (data) {
                var roleClass = '';

                // Set the appropriate class based on the role value
                if (data.toLowerCase() === 'technician') {
                    roleClass = 'roleTechnician';
                } else if (data.toLowerCase() === 'admin') {
                    roleClass = 'roleAdmin';
                } else if (data.toLowerCase() === 'client') {
                    roleClass = 'roleClient';
                }

                // Wrap the content in a div with the appropriate class
                return '<div class="' + roleClass + '">' + data.charAt(0).toUpperCase() + data.slice(1) + '</div>';
            } 
        },
        // {   data: 'created_at', 
        //     name: 'created_at',
        //     className: 'none',  
        //     render: function (data) {
        //     return new Date(data).toLocaleString("en-GB"); 
        // }},
        {
        data: 'created_at',
        name: 'created_at',
        className: 'none',
        render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY hh:mm A');
              }},
        {   data: 'updated_at', 
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
                      
        ],
        rowCallback: function(row, data, index) {
            if (data.role == "admin") {
            $("td:eq(5)", row).addClass("roleAdmin");
            }

            if (data.role == "client") {
            $("td:eq(5)", row).addClass("roleClient");
            }

            if(data.role == "technician"){
            $("td:eq(5)", row).addClass("roleTechnician");
            }
    }
        });
    });


    



    


    



    
</script>

