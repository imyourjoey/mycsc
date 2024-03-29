<x-layout>
    <style>
        .invoicePaid div{
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

        .invoiceUnpaid div{
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
  <x-navbar/>
  <div class="container-fluid">
      <div class="h1 ml-2 mt-4 mb-4 font-weight-bold">Invoices</div>

      <div style="margin-top: 1rem"></div>
      <table class="display cell-border" id="invoices-table" style="width: 100%;">
          <thead>
              <tr>
                  <th style="max-width: 20px"></th>
                  <th class="colvis">Invoice ID</th>
                  <th class="colvis">Order ID</th>
                  <th class="colvis">Client Name</th>
                  <th class="colvis">Total Payable</th>
                  <th class="colvis">Invoice Due Date</th>
                  <th class="colvis">Payment Amount</th>
                  <th class="colvis">Payment Method</th>
                  <th class="colvis">Payment Status</th>
                  <th class="colvis">Payment Date</th>
                  <th class="colvis">Created At</th>
                  <th class="colvis">Updated At</th>
                  <th style="max-width: 40px"></th>
              </tr>
          </thead>
      </table>
  </div>



</x-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


{{-- Initialize DataTable --}}
<script>
  $(function () {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      var table = $('#invoices-table').DataTable({
          rowId: 'invoiceID',
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
                          return 'Invoice Information';
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
              url: '{{ route('admin.invoice.index') }}',
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
                  buttons: ['excel', {
                      extend: 'pdfHtml5',
                      orientation: 'landscape',
                      pageSize: 'LEGAL'
                  }]
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
                      columns: [1, 2, 3, 4, 5, 6]
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
                      window.location = "{{ route('admin.invoice.create') }}";
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
                          // Redirect to the invoice details page with the selected invoice's ID
                          window.location = "{{ route('admin.invoice.edit', ['invoice' => ':invoiceID']) }}".replace(':invoiceID', selectedData.invoiceID);
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
                              url: "{{ route('admin.invoice.destroy') }}",
                              type: "DELETE",
                              data: { selectedIds: selectedIds },
                              headers: {
                                  'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                              },
                              success: function (response) {
                                  toastr.success('Selected record(s) have been deleted successfully');
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
              {
                extend: 'selectedSingle', 
                  text: 'Invoice',
                  action: function (e, dt, button, config) {
                      // Get the selected data
                      var selectedData = table.row({ selected: true }).data();

                      if (selectedData) {
                          // Redirect to the invoice details page with the selected invoice's ID
                          window.open("{{ route('admin.invoice.showInvoice', ['invoice' => ':invoiceID']) }}".replace(':invoiceID', selectedData.invoiceID),'_blank');
                      }
                  }
              },
              {
                extend: 'selectedSingle', 
                  text: 'Receipt',
                  action: function (e, dt, button, config) {
                      // Get the selected data
                      var selectedData = table.row({ selected: true }).data();
                        
                      if (selectedData.paymentStatus === 'paid' && selectedData.paymentStatus !==null) {
                          // Redirect to the invoice details page with the selected invoice's ID
                          window.open("{{ route('admin.invoice.showReceipt', ['invoice' => ':invoiceID']) }}".replace(':invoiceID', selectedData.invoiceID),'_blank');
                      }else{
                        toastr.error('Receipts can only be generated for paid invoices')
                      }
                  }
              }
          ],
          columnDefs: [{
              targets: -1,
              orderable: false,
              className: 'dtr-control arrow-right',
          },
          {
            targets: [1,2,3,4,5,6,7,8],
            defaultContent:"N/A"
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
              { data: 'invoiceID', name: 'invoiceID' },
              { data: 'orderID', name: 'orderID' },
              { data: 'clientName', name: 'clientName' },
              { data: 'totalPayable', 
                name: 'totalPayable',
                render: function (data) {
                      return 'RM' + data;
                    } 
              },
              { data: 'invoiceDueDate', 
                name: 'invoiceDueDate',
                render: function (data) {
                    var date = moment(data);
                    return date.format('DD/MM/YY');
                
              }},
              { data: 'paymentAmount', 
                name: 'paymentAmount',
                render: function (data) {
                      if (data){
                        return 'RM' + data;
                      }
                      
                }  
              },
              { data: 'paymentMethod', name: 'paymentMethod' },
              { data: 'paymentStatus', 
                name: 'paymentStatus',
                render: function (data, type, row, meta) {
            // Wrap the content in a div with the appropriate class
            var statusClass = data.toLowerCase() === 'paid' ? 'invoicePaid' : 'invoiceUnpaid';
            return '<div class="' + statusClass + '">' + data.charAt(0).toUpperCase() + data.slice(1) + '</div>';
        }
              },
              {
                  data: 'paymentDate',
                  name: 'paymentDate',
                  render: function (data) {
                    if (data) {
                        var date = moment(data);
                    return date.format('DD/MM/YY');
            } else {
            return 'N/A'; // or any other default value for null dates
            }
            }},
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
          ],
            rowCallback: function(row, data, index) {
            if (data.paymentStatus == "paid") {
            $("td:eq(8)", row).addClass("invoicePaid");
            }

            if (data.paymentStatus == "pending") {
            $("td:eq(8)", row).addClass("invoiceUnpaid");
      }
    }
      });
  });


</script>


    
