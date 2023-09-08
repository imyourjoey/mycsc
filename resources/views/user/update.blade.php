<x-layout>
  <x-navbar/>
  
  
  {{-- create new user form --}}
  <div class="container text-left create-user-form">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="POST" action={{ route('user.update', ['user' => $user->id]) }} id="editUserForm">
          @csrf
         
          <div>
            <h2 class="text-left">Update User Details</h2>
            <p class="text-left">Please review and update the user's information</p>
          </div>
          <div class="form-group">
            <label for="role">User Role:</label>
            <input type="text" class="form-control" id="role" value="{{ ucfirst($user->role) }}" placeholder="Enter username" name="username" readonly>
            
          </div>
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" value="{{ $user->username }}" placeholder="Enter username" name="username" readonly>
  
            @error('username')
              <p class="text-red-500 text-xs mt-1">Please enter a unique username</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" class="form-control" id="fullName" value="{{ ucfirst($user->name) }}" placeholder="Enter full name" name="name">
  
            @error('name')
            <p class="text-red-500 text-xs mt-1">Please enter your name</p>
            @enderror
  
          </div>
          <div class="form-group">
            <label for="phoneNo">Phone Number:</label>
            <input type="tel" class="form-control" id="phoneNumber" value="{{ $user->phoneNo }}" placeholder="Enter phone number" name="phoneNo">
  
            @error('phoneNo')
            <p class="text-red-500 text-xs mt-1">Please enter your phone number</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Enter email" name="email">
  
            @error('email')
            <p class="text-red-500 text-xs mt-1">Please enter a valid email address</p>
            @enderror
          </div>
        </div>
        <div class="col-md-6" style="margin-top: 5.4rem">
          <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" value="{{ $user->password }}" placeholder="Enter password" name="password" readonly>
              <div class="input-group-append">
                <span class="input-group-text eye-icon">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            @error('password')
            <p class="text-red-500 text-xs mt-1">Please enter a matching password</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="confirmPassword" value="{{ $user->password }}" placeholder="Confirm password" name="password_confirmation" readonly>
              <div class="input-group-append">
                <span class="input-group-text eye-icon">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
              </div>
            </div>
            <div class="form-group">
              @error('password_confirmation')
              <p class="text-red-500 text-xs mt-1">Please enter a matching password</p>
              @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-create btn-block">Update <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
        </form>
      </div>
    </div>
  </div>
  </x-layout>