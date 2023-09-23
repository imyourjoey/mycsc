<x-layout>
  <x-navbar/>

  {{-- create new user form --}}
  <div class="container text-left create-user-form">
    @if(session()->has('message'))
    <div class="row">
        <div class="form-group col-md-6">
            <a href="{{ route('admin.user.index') }}">
            <button class=" d-block btn btn-primary fade-in-button" >Back to Users</button>
            </a>   
        </div>
    </div>
  @endif
    <div class="row">
      <div class="col-md-6">
        <form method="POST" action={{ route('admin.user.update', ['user' => $user->id]) }} id="editUserForm">
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
            <label for="name">Full Name:</label>
            <input type="text" class="form-control" id="fullName" value="{{ ucfirst($user->name) }}" placeholder="Enter full name" name="name">
  
            @error('name')
            <p class="text-red-500 text-xs mt-1">Please enter your name</p>
            @enderror
  
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Enter email" name="email">
  
            @error('email')
            <p class="text-red-500 text-xs mt-1">Please enter a valid email address</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="phoneNo">Phone Number:</label>
            <input type="tel" class="form-control" id="phoneNumber" value="{{ $user->phoneNo }}" placeholder="Enter phone number" name="phoneNo">
  
            @error('phoneNo')
            <p class="text-red-500 text-xs mt-1">Please enter your phone number</p>
            @enderror
          </div>
          <div class="form-group mt-4">
            <button type="submit" class="btn btn-create btn-block">Update <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
          </div>

        </div>
    </div>
  </div>
  </x-layout>