<x-layout>
  <x-navbar />
  
  <div class="container" id="hello">
      <div class="mt-4 mb-4">
        @if(session()->has('message'))
        <div class="row">
            <div class="form-group col-md-6">
                <a href="{{ route('admin.invoice.index') }}">
                <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Invoices</button>
                </a>   
            </div>
        </div>
      @endif
          <p class="h2">Edit Invoice</p>
          <p>Please fill in the following information to edit invoice details.</p>
      </div>

      <form method="POST" action="{{ route('admin.invoice.update', ['invoice' => $invoice->invoiceID]) }}" id="editInvoiceForm">
          @csrf
          @method('PUT')

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="orderID">Order ID<span class="form-required">*</span></label>
                  <select class="selectpicker form-control border bg-white" id="orderID" data-live-search="true"
                      name="orderID" disabled>
                      <option disabled>-Select Order ID-</option>
                      @foreach ($orders as $order)
                      <option value="{{ $order->orderID }}" @if(old('orderID', $invoice->orderID) === $order->orderID ) selected @endif>
                          {{ $order->orderID }} - {{ $order->name }}
                      </option>
                      @endforeach
                  </select>

                  @error('orderID')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="dueDate">Invoice Due Date<span class="form-required">*</span></label>
                  <input type="text" class="form-control selector bg-white" id="dueDate"
                      placeholder="Select invoice due date" name="dueDate" value="{{ old('dueDate', $invoice->invoiceDueDate) }}">
                  
                  @error('dueDate')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-3">
                  <label for="totalPayable">Total Payable<span class="form-required">*</span></label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">MYR</span>
                      </div>
                      <input type="text" class="form-control" id="totalPayable" placeholder="00.00"
                          name="totalPayable" value="{{ old('totalPayable', $invoice->totalPayable) }}">
                  </div>

                  @error('totalPayable')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              
              <div class="form-group col-md-3">
                  <label for="amountPaid">Amount Paid</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">MYR</span>
                      </div>
                      <input type="text" class="form-control" id="amountPaid" placeholder="00.00"
                          name="amountPaid" value="{{ old('amountPaid', $invoice->paymentAmount) }}">
                  </div>
                  @error('amountPaid')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="paymentStatus">Payment Status</label>
                  <select name="paymentStatus" class="border form-control selectpicker" id="paymentStatus">
                      <option disabled>-Select Payment Status-</option>
                      <option value="pending" @if(old('paymentStatus', $invoice->paymentStatus) === 'pending') selected @endif>
                          Pending</option>
                      <option value="paid" @if(old('paymentStatus', $invoice->paymentStatus) === 'paid') selected @endif>
                          Paid</option>
                  </select>
                  @error('paymentStatus')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="paymentMethod">Payment Method</label>
                  <input type="text" class="form-control" id="paymentMethod"
                      placeholder="Enter payment method (optional)" name="paymentMethod"
                      value="{{ old('paymentMethod', $invoice->paymentMethod) }}">
                  @error('paymentMethod')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <br>
                  <button type="submit" class="btn btn-primary btn-block">Update <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>
              </div>
          </div>
      </form>
  </div>


</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Initialize Datepicker
      $(".selector").flatpickr({
          dateFormat: "Y-m-d",
          time_24hr: true,
          minDate: "today"
      });
  });
</script>

