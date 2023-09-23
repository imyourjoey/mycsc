<x-layout>
    <x-navbar />


    <div class="container">

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
            <p class="h2">Create New Invoice</p>
            <p>Please fill in the following information to create an invoice.</p>
        </div>

        <form method="POST" action={{ route('admin.invoice.store') }} id="createInvoiceForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="orderID">Order ID<span class="form-required">*</span></label>
                    <select class="selectpicker form-control border bg-white" id="orderID" data-live-search="true" name="orderID">
                        <option disabled selected>-Enter Order ID-</option>
                        @foreach ($orders as $order)
                        <option value="{{ $order->orderID }}" @if(old('orderID')=== $order->orderID ) selected @endif>{{ $order->orderID }} - {{ $order->name }}</option>
                      @endforeach
                      </select>


                    @error('orderID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="dueDate">invoice Due Date<span class="form-required">*</span></label>
                    
                   
                    <input type="text" class="form-control selector bg-white" id="dueDate" placeholder="Select invoice due date"
                        name="dueDate" value="{{ old('dueDate') }}">
                    
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
                            name="totalPayable" value="{{ old('totalPayable') }}">
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
                            name="amountPaid" value="{{ old('amountPaid') }}">
                        </div>
                    @error('amountPaid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="row">
                <div class="form-group col-md-6">
                    <label for="paymentStatus">Payment Status</label>
                    <select name="paymentStatus" class=" border form-control selectpicker" id="paymentStatus">
                        <option disabled selected>-Select payment status-</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                    </select>
                    @error('paymentStatus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="paymentMethod">Payment Method</label>
                    <input type="text" class="form-control" id="paymentMethod" placeholder="Enter payment method (optional)"
                        name="paymentMethod" value="{{ old('paymentMethod') }}">

                    @error('paymentMethod')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Create <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>
        </form>
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //initialize Datepicker
        $(".selector").flatpickr({
          dateFormat: "Y-m-d",
          time_24hr: true,
          minDate: "today"
        });

    }); 
    </script>

