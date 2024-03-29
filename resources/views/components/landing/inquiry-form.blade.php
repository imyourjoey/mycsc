@vite('resources/css/inquiry-form.css')


{{-- inquiry form --}}
<div id="hello"></div>
<div class="container form-container pt-5 pb-2" id="inquiry-form">
  <div class="col-sm-6">
    <h2 class="text-center">Inquiry Form</h2>
    <p class="text-center"> Please fill out this form. We will get in touch with you shortly.</p>
    <form id="inquiryform" method="POST" action="{{ route('submitGuestInquiry') }}">
      @csrf
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="inquiryName" value="{{ old('inquiryName') }}">

        @error('inquiryName')
        <p class="invalid-feedback" >Please enter your name</p>
        @enderror

      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="inquiryContactEmail" value="{{ old('inquiryContactEmail') }}">

        @error('inquiryContactEmail')
        <p class="invalid-feedback">Please enter a valid email address</p>
        @enderror

      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control" type="text" id="message" rows="5" placeholder="Enter your message" name="inquiryMessage">{{ old('inquiryMessage') }}</textarea>

        @error('inquiryMessage')
        <p class="invalid-feedback">Please enter your message</p>
        @enderror
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary submit-button" >Submit</button>
      </div>
    </form>
  </div>
</div>




