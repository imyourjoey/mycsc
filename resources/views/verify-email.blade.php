<x-layout>

    <div class="container">

        <div class="mt-4 mb-4">
            @if(session()->has('message'))
            <div class="row">
                <div class="form-group col-md-6">
                    <a href="{{ route('inquiry.index') }}">
                    <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Inquiries</button>
                    </a>   
                </div>
            </div>
          @endif
          <p class="h2">Welcome, {{ auth()->user()->name }}!</p>
          <p class="col-6 p-0">Before we start, we need to make sure it's really you. Just enter your email and the 6-digit code we sent to your email address.</p>
        </div>

        <form method="POST" action={{ route('verifyEmail',['user' => auth()->user()->id]) }} id="verifyEmailForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your email address" name="email"
                        value="{{ old('email', auth()->user()->email) }}" readonly>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="otp">6-digit code (OTP) <span class="form-required">*</span></label>
                    <input type="password" class="form-control" id="otp" placeholder="Enter 6-digit code (OTP)" name="otp" value="{{ old('otp' )}}" >

                    @error('otp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 mt-3">
                    <button type="submit" class="btn btn-primary btn-block">Submit <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>
        </form>
    </div>


</x-layout>