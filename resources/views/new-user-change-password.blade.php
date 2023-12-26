<x-layout>
  <x-navbar/>

  {{-- Change Password Form --}}
  <div class="container text-left create-user-form">
    <div class="row">
      <div class="col-md-6">
        <form method="POST" action="{{ route('password.update', ['user' => $user->id]) }}" id="editPasswordForm">
          @csrf

          <div>
            <h2 class="text-left">Hi, {{ auth()->user()->name }}</h2>
            <p>Consider updating your password to enhance security. Kindly fill out the form below.</p>
          </div>
          <div class="form-group">
            <label for="oldPassword">Old Password<span class="form-required">*</span></label>
            <input type="password" class="form-control" id="oldPassword" placeholder="Enter your old password" name="oldPassword">

            @error('oldPassword')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="newPassword">New Password<span class="form-required">*</span></label>
            <input type="password" class="form-control" id="newPassword" placeholder="Enter your new password" name="newPassword">

            @error('newPassword')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="confirmNewPassword">Confirm New Password<span class="form-required">*</span></label>
            <input type="password" class="form-control" id="confirmNewPassword" placeholder="Confirm your new password" name="confirmNewPassword">

            @error('confirmNewPassword')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mt-4">
            <button type="submit" class="btn btn-create btn-block">Update <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Additional content if needed -->
  </div>
</x-layout>
