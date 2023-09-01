<x-layout>
<x-navbar/>


{{-- Font Awesome  --}} 
<link rel='stylesheet'
   href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

{{-- DataTables Buttons CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


<!-- DataTables Select CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">

{{-- DataTables SearchBuilder --}}
<link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.5.0/css/searchBuilder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">



{{-- DataTables State Restore --}}
<link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.3.0/css/stateRestore.dataTables.min.css">


{{-- DataTables Responsive --}}
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css
">

    <div style="margin-top: 1rem"></div>
    <table class="display cell-border" id="users-table" style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
    </table>





{{-- bootstrap js --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>


<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- JSZip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- DataTables Select JS -->
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>


{{-- DataTables SearchBuilder --}}
<script src="https://cdn.datatables.net/searchbuilder/1.5.0/js/dataTables.searchBuilder.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


{{-- State Restore --}}
<script src="https://cdn.datatables.net/staterestore/1.3.0/js/dataTables.stateRestore.min.js"></script>

{{-- DataTables Responsive --}}
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>



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
                url: '{{ route('user.index') }}',
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
            window.location =  "{{ route('user.show-create') }}" ;
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
                            window.location = "{{ route('user.show-update', ['id' => ':id']) }}".replace(':id', selectedData.id);

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
                url: "{{ route('user.destroy') }}",
                type: "POST",
                data: { selectedIds: selectedIds },
                headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    alert(response.message);
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
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'created_at', name: 'created_at',  render: function (data) {
            return new Date(data).toLocaleString("en-GB"); 
        }},
        { data: 'updated_at', name: 'updated_at' , render: function (data) {
            return new Date(data).toLocaleString("en-GB");}}
                      
        ]
        });
    });



    


    



    
</script>
</html>
</x-layout>
