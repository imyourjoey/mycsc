<x-layout>
    <x-navbar />


    <div class="container">

        <div class="mt-4 mb-4">
            <p class="h2">Create New Invoice</p>
            <p>Please fill in the following information to create an invoice.</p>
        </div>

        <form method="POST" action={{ route('user.create') }} id="createUserForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="orderID">Order ID<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="orderID" placeholder="Enter the Order ID"
                        name="orderID" value="{{ old('orderID') }}">

                    @error('orderID')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="clientName">Client Name<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="clientName" placeholder="Enter the client's full name"
                        name="clientName" value="{{ old('clientName') }}">

                    @error('clientName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="dueDate">invoice Due Date<span class="form-required">*</span></label>
                    
                   
                    <input type="text" class="form-control" id="dueDate" placeholder="Select invoice due date"
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
                    <label for="amountPaid">Amount Paid<span class="form-required">*</span></label>
                    <<div class="input-group">
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
                    <label for="paymentStatus">Payment Status<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="paymentStatus" placeholder="Enter payment status (optional)"
                        name="paymentStatus" value="{{ old('paymentStatus') }}">

                    @error('paymentStatus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="paymentMethod">Payment Method<span class="form-required">*</span></label>
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
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>
