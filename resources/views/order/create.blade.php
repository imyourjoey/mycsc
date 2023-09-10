<x-layout>
    <x-navbar />


    <div class="container">
        <div class="mt-4 mb-4">
            <p class="h2">Create New Order</p>
            <p>Please fill in the following information to create a new order.</p>
        </div>

        <form method="POST" action={{ route('order.store') }} id="createOrderForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="h5 mt-2 mb-3">Order Details</div>
                    <label for="serviceType">Service Type <span class="form-required">*</span></label>
                    <select class="selectpicker form-control border" id="serviceType" data-live-search="true" name="serviceType">
                        <option disabled selected>-Enter service type-</option>
                        @foreach ($services as $service)
                        <option value="{{ $service->serviceName }}" @if(old('serviceType')=== $service->serviceName ) selected @endif>{{ $service->serviceName }}</option>
                      @endforeach
                      </select>

                    @error('serviceType')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <div class="h5 mt-2 mb-3"> Hardware Details</div>
                    <label for="deviceType">Device Type <span class="form-required">*</span></label>
                    <select class="selectpicker form-control border" id="deviceType" name="deviceType">
                        <option disabled selected>-Enter device type-</option>
                        <option value="Thumb Drive" @if(old('deviceType')==="Thumb Drive") selected @endif>Thumb Drive</option>
                        <option value="Hard Disk" @if(old('deviceType')==="Hard Disk") selected @endif>Hard Disk</option>
                        <option value="Other" @if(old('deviceType')==="Other") selected @endif>Other</option>
                      </select>

                    @error('deviceType')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="clientName">Client Name <span class="form-required">*</span></label>
                    <select class="selectpicker form-control border" id="clientName" data-live-search="true" name="clientName">
                        <option disabled selected>-Enter client name-</option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->name }}" @if(old('clientName')=== $client->name ) selected @endif>{{ $client->name }} - {{ $client->userTag }}</option>
                      @endforeach
                      </select>

                    @error('clientName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="manufacturer">Manufacturer</label>
                    <input type="text" class="form-control" id="manufacturer"
                        placeholder="Please enter device manufacturer (optional)" name="manufacturer"
                        value="{{ old('manufacturer') }}">

                    @error('manufacturer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="assignedTechnician">Assigned Technician <span class="form-required">*</span></label>
                    <select class="selectpicker form-control border" id="assignedTechnician" data-live-search="true" name="assignedTechnician">
                        <option disabled selected>-Enter assigned technician name-</option>
                        @foreach ($technicians as $technician)
                        <option value="{{ $technician->name }}" @if(old('assignedTechnician')=== $technician->name ) selected @endif >{{ $technician->name }} - {{ $technician->userTag }}</option>
                      @endforeach
                      </select>

                    @error('assignedTechnician')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="partNo">Part No.</label>
                    <input type="text" class="form-control" id="partNo" placeholder="Please enter part number (optional)"
                        name="partNo" value="{{ old('partNo') }}">

                    @error('partNo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="orderStatus">Order Status<span class="form-required">*</span></label>
                    <select id="orderStatus" class="form-control selectpicker border" name="orderStatus" value="{{ old('orderStatus') }}">
                        <option disabled selected>-Select order status-</option>

                        <option value="Initial Diagnostics" @if(old('orderStatus')==='Initial Diagnostics' ) selected @endif>Initial Diagnostics</option>
                        <option value="In Progress" @if(old('orderStatus')==='In Progress' ) selected @endif>In Progress</option>
                        <option value="New Disk Required" @if(old('orderStatus')==='New Disk Required' ) selected @endif>New Disk Required</option>
                        <option value="Ready for Pickup" @if(old('orderStatus')==='Ready for Pickup' ) selected @endif>Ready for Pickup</option>
                        <option value="Payment Pending" @if(old('orderStatus')==='Payment Pending' ) selected @endif>Payment Pending</option>
                        <option value="Completed" @if(old('orderStatus')==='Completed' ) selected @endif>Completed</option>
                        <option value="Cancelled" @if(old('orderStatus')==='Cancelled' ) selected @endif>Cancelled</option>

                    </select>

                    @error('orderStatus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="serialNo">Serial No.</label>
                    <input type="text" class="form-control" id="serialNo" placeholder="Please enter serial number (optional)"
                        name="serialNo" value="{{ old('serialNo') }}">

                    @error('serialNo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="statusPic">Order Status Image</span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="statusPic" name="statusPic">
                        <label class="custom-file-label" for="statusPic">
                        @if(old('statusPic'))
                            {{ old('statusPic') }} 
                        @else
                            Upload an image of the current order status (optional)
                        @endif</label>
                    </div>

                    @error('statusPic')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="othersIncluded">Others Included</label>
                    <input type="text" class="form-control" id="othersIncluded"
                        placeholder="Please enter others included (optional)" name="othersIncluded"
                        value="{{ old('othersIncluded') }}">

                    @error('othersIncluded')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="remarks">Remarks</label>
                    <textarea type="text" class="form-control" id="remarks"
                        placeholder="Please enter order remarks (optional)" name="remarks"
                        value="{{ old('remarks') }}" rows="1"></textarea>

                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 pr-1">
                    <label for="diskCapacity">Disk Capacity</label>
                    <input type="text" class="form-control" id="diskCapacity" placeholder="Disk Capacity (in GB)"
                        name="diskCapacity" value="{{ old('diskCapacity') }}">

                    @error('diskCapacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3 pl-1">
                    <label for="capacityRestored">Capacity Restored</label>
                    <input type="text" class="form-control" id="capacityRestored"
                        placeholder="Capacity Restored (in GB)" name="capacityRestored"
                        value="{{ old('capacityRestored') }}">

                    @error('capacityRestored')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


            </div>




            <div class="row">
                <div class="form-group col-md-6 mt-3">
                    <button type="submit" class="btn btn-primary btn-block">Create <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>
        </form>
    </div>
</x-layout>
