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
                  <th class="colvis">Payment Status</th>
                  <th class="colvis">Payment Amount</th>
                  <th class="colvis">Payment Method</th>
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
                          return 'Invoice Information' + data.invoiceID;
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
              url: '{{ route('client.invoice.index') }}',
              type: 'GET'
          },
          dom: 'Bfrtip', // Specify the buttons to display
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], // Options for the length menu
          buttons: [

              {
                  extend: 'spacer',
                  text: 'Generate:'
              },
              
              {
                extend: 'selectedSingle', 
                  text: 'Invoice',
                  action: function (e, dt, button, config) {
                      // Get the selected data
                      var selectedData = table.row({ selected: true }).data();

                      if (selectedData) {
                          // Redirect to the invoice details page with the selected invoice's ID
                          window.open("{{ route('client.invoice.showInvoice', ['invoice' => ':invoiceID']) }}".replace(':invoiceID', selectedData.invoiceID),'_blank');
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
                          window.open("{{ route('client.invoice.showReceipt', ['invoice' => ':invoiceID']) }}".replace(':invoiceID', selectedData.invoiceID),'_blank');
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
              { data: 'invoiceDueDate', name: 'invoiceDueDate' },
              { data: 'paymentStatus', 
                name: 'paymentStatus',
                render: function (data) {
                    return '<div>' + data.charAt(0).toUpperCase() + data.slice(1) + '</div>';
              } 
              },
              { data: 'paymentAmount', 
                name: 'paymentAmount',
                render: function (data) {
                      if (data){
                        return 'RM' + data;
                      }
                      
                }  
              },
              { data: 'paymentMethod', name: 'paymentMethod' },
              {
                  data: 'paymentDate',
                  name: 'paymentDate',
                  render: function (data) {
                    if (data) {
            var date = new Date(data);
            var monthAbbreviation = date.toLocaleString("en-GB", { month: 'short' });
            var formattedDate = date.getDate() + ' ' + monthAbbreviation + '. ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
            return formattedDate;
            } else {
            return 'N/A'; // or any other default value for null dates
            }
            }},
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
          ],
          rowCallback: function(row, data, index) {
            if (data.paymentStatus == "paid") {
            $("td:eq(6)", row).addClass("invoicePaid");
            }

            if (data.paymentStatus == "pending") {
            $("td:eq(6)", row).addClass("invoiceUnpaid");
            }
    }
      });
  });


</script>


    
