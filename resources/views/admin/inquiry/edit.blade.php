<x-layout>
  <x-navbar />
  <div class="container">

      <div class="mt-4 mb-4">
        @if(session()->has('message'))
        <div class="row">
            <div class="form-group col-md-6">
                <a href="{{ route('admin.inquiry.index') }}">
                <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Inquiries</button>
                </a>   
            </div>
        </div>
      @endif
          <p class="h2">Edit Inquiry</p>
          <p>Please change the information below update inquiry details.</p>
      </div>

      <form method="POST" action="{{ route('admin.inquiry.update', ['inquiry' => $inquiry]) }}" id="editInquiryForm">
          @csrf
          @method('PUT') <!-- Use the PUT method for updating -->
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="name">Name<span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="name" placeholder="Enter your full name" name="name"
                      value="{{ old('name', $inquiry->inquiryName) }}" readonly>

                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="inquiryMessage">Inquiry/Message <span class="form-required">*</span></label>
                  <textarea type="text" class="form-control" id="inquiryMessage"
                      placeholder="Type your inquiry or message here" name="inquiryMessage" rows="4">{{ old('inquiryMessage', $inquiry->inquiryMessage) }}</textarea>

                  @error('inquiryMessage')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

          </div>

          <div class="row">
            <div class="form-group col-md-6">
                <label for="inquiryReply">Inquiry/Message <span class="form-required">*</span></label>
                <textarea type="text" class="form-control" id="inquiryReply"
                    placeholder="Type your reply" name="inquiryReply" rows="4">{{ old('inquiryReply', $inquiry->inquiryReply) }}</textarea>

                @error('inquiryReply')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="email">Contact Email <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="email" placeholder="Enter your email address"
                      name="email" value="{{ old('email', $inquiry->inquiryContactEmail) }}" readonly>

                  @error('email')
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
