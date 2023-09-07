<x-layout>
    <x-navbar />


    <div class="container">
        <div class="mt-4 mb-4">
            <p class="h2">Create New Order</p>
            <p>Please fill in the following information to create a new order.</p>
        </div>

        <form method="POST" action={{ route('user.create') }} id="createUserForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="h5 mt-2 mb-3">Order Details</div>
                    <label for="serviceType">Service Type <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="serviceType" placeholder="Please select the service type"
                        name="serviceType" value="{{ old('serviceType') }}">

                    @error('serviceType')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <div class="h5 mt-2 mb-3"> Hardware Details</div>
                    <label for="deviceType">Device Type <span class="form-required">*</span></label>
                    <input type=deviceType" class="form-control" id="deviceType" placeholder="Please enter the device type"
                        name="deviceType" value="{{ old('deviceType') }}">

                    @error('deviceType')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="deviceType">Client Name <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="deviceType" placeholder="Please enter the client's name"
                        name="deviceType" value="{{ old('deviceType') }}">

                    @error('deviceType')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="manufacturer">Manufacturer<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="manufacturer" placeholder="Please enter device manufacturer"
                        name="manufacturer" value="{{ old('manufacturer') }}">

                    @error('manufacturer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="technicianName">Assigned Technician <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="technicianName" placeholder="Please enter assigned technician name"
                        name="technicianName" value="{{ old('technicianName') }}">

                    @error('technicianName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="partNo">Part No.<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="partNo" placeholder="Please enter part number"
                        name="partNo" value="{{ old('partNo') }}">

                    @error('partNo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="orderStatus">Order Status</span></label>
                    <input type="text" class="form-control" id="orderStatus" placeholder="Please enter order status (optional)"
                        name="orderStatus" value="{{ old('orderStatus') }}">

                    @error('orderStatus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="serialNo">Serial No.<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="serialNo" placeholder="Please enter serial number"
                        name="serialNo" value="{{ old('serialNo') }}">

                    @error('serialNo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="statusPic">Status Picture</span></label>
                    <input type="text" class="form-control" id="statusPic" placeholder="Please choose order status picture (optional)"
                        name="statusPic" value="{{ old('statusPic') }}">

                    @error('statusPic')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="othersIncluded">Others Included<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="othersIncluded" placeholder="Please enter others included (optional)"
                        name="othersIncluded" value="{{ old('othersIncluded') }}">

                    @error('othersIncluded')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="remarks">Remarks</label>
                    <textarea type="text" class="form-control" id="remarks" placeholder="Please enter order remarks (optional)"
                        name="remarks" value="{{ old('remarks') }}" rows="1"></textarea>

                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 pr-1">
                    <label for="diskCapcacity">Disk Capacity<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="diskCapcacity" placeholder="Disk Capacity (in GB)"
                        name="diskCapcacity" value="{{ old('diskCapcacity') }}">

                    @error('diskCapcacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3 pl-1">
                    <label for="capacityRestored">Capacity Restored<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="capacityRestored" placeholder="Capacity Restored (in GB)"
                        name="capacityRestored" value="{{ old('capacityRestored') }}">

                    @error('capacityRestored')
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
