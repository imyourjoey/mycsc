<x-layout>
    <x-navbar />
    <div class="container">

        <div class="mt-4 mb-4">
            <p class="h2">Submit Your Inquiry!</p>
            <p>Please fill out the form below, and we'll get back to you as soon as possible.</p>
        </div>

        <form method="POST" action={{ route('user.create') }} id="createUserForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name<span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your full name" name="name"
                        value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inquiryMessage">Your Inquiry/Message <span class="form-required">*</span></label>
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
                    <label for="email">Contact Email <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your email address"
                        name="email" value="{{ old('email') }}">

                    @error('email')
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