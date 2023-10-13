<x-layout>

  
  <x-navbar/>

  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <div class="h2 mt-4 font-weight-bold">My Inquiries</div>

        <table class="display cell-border" id="client-appointments-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="max-width: 20px"></th>
                    <th class="colvis">ID</th>
                    <th class="colvis" style="max-width: 25px">No.</th>
                    <th class="colvis">Inquiry</th>
                    <th class="colvis">Reply</th>
                    <th style="max-width: 40px"></th>
                </tr>
            </thead>
        </table>
      </div>
    </div>



    {{-- Submit Inquiry --}}
    <div class="h2 mt-4 font-weight-bold">Submit Inquiries</div>
    <p>Please fill out the form below, and we'll get back to you as soon as possible.</p>
    
    <form method="POST" action={{ route('client.inquiry.store') }} id="submitInquiryForm">
      @csrf
    <div class="row">
      <div class="form-group col-md-6">
        {{-- <label for="inquiryMessage">Your Inquiry/Message <span class="form-required">*</span></label> --}}
        <textarea type="text" class="form-control" id="inquiryMessage"
            placeholder="Type your inquiry or message here" name="inquiryMessage"
            value="{{ old('inquiryMessage') }}" rows="4"></textarea>

        @error('inquiryMessage')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
          <button type="submit" class="btn btn-primary btn-block">Submit <i class="fa fa-arrow-right"
                  aria-hidden="true"></i></button>

      </div>
  </div>
    </form>
  </div>
</x-layout>

{{-- Initialize DataTable --}}
<script>
  $(function () {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      var table = $('#client-appointments-table').DataTable({
        rowId: 'inquiryID',
          // language: {
          //     searchBuilder: {
          //         button: 'Filter'
          //     },
          //     buttons: {
          //         savedStates: {
          //             0: 'Saved States',
          //             _: 'Saved States (%d)'
          //         }
          //     }
          // },
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
                          return 'Details of ' + data.appointmentID;
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
          ajax: {
              url: '{{ route('client.inquiry.index') }}',
              type: 'GET'
          },
          dom: 'Bfrtip',
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          buttons: [
              // 'pageLength',
              // {
              //     extend: 'colvis',
              //     text: 'Show/Hide',
              //     columns: 'th.colvis',
              //     columnText: function (dt, idx, title) {
              //         if (idx == 0) {
              //             return 'Checkbox';
              //         } else {
              //             return title;
              //         }
              //     }
              // },
              // {
              //     extend: 'collection',
              //     text: 'Export',
              //     buttons: ['excel', {
              //         extend: 'pdfHtml5',
              //         orientation: 'landscape',
              //         pageSize: 'LEGAL'
              //     }]
              // },
              // {
              //     extend: 'collection',
              //     text: 'Select',
              //     buttons: ['selectAll', 'selectNone']
              // },
              // {
              //     extend: 'searchBuilder',
              //     config: {
              //         depthLimit: 2,
              //         columns: [0, 1, 2, 3, 4, 5]
              //     }
              // },
              {
                    extend: 'spacer',
                    text: 'Action:'
              },
              {
                  extend: 'selected',
                  text: 'Delete',
                  action: function (e, dt, button, config) {
            var selectedIds = table.rows({selected: true}).ids().toArray();
            
    
    
            if (selectedIds.length === 0) {
                alert('No records selected for deletion.');
                return;
            }
    
            if (confirm('Are you sure you want to delete the selected records?')) {
                $.ajax({
                    url: "{{ route('client.inquiry.destroy') }}",
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
              },
          ],
          columnDefs:
            [{
                targets:-1,
                orderable:false,
                className: 'dtr-control arrow-right',
               
            },
            {
            target: 1,
            visible: false,
            searchable: false
        },
          ],
          columns: [
              {
                targets:0,
                data: null,
                defaultContent: '',
                orderable: false, 
                className: 'select-checkbox'
              },

              
              { data: 'inquiryID', name: 'inquiryID' },
              { data: 'rowNumber', name: 'rowNumber' },
              { data: 'inquiryMessage', name: 'inquiryMessage' },
              { data: 'inquiryReply', name: 'inquiryReply' },
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