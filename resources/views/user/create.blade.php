{{-- <x-layout>
<x-navbar/>



<div class="container text-left create-user-form">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="POST" action={{ route('user.create') }} id="createUserForm">
@csrf
<div>
    <h2 class="text-left">Create New User</h2>
    <p class="text-left">Please fill in the following information to create a new user.</p>
</div>
<div class="form-group">
    <label for="userRole">User Role:</label>
    <select name="role" class="form-control" id="userRole" onchange="updateFormAction()">
        <option value="" disabled selected>Select a role</option>
        <option value="client">Client</option>
        <option value="technician">Technician</option>
        <option value="admin">Admin</option>

    </select>
    @error('role')
        <p class="text-red-500 text-xs mt-1">Please select user role</p>
    @enderror

</div>
<div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">

    @error('username')
        <p class="text-red-500 text-xs mt-1">Please enter a unique username</p>
    @enderror
</div>
<div class="form-group">
    <label for="name">Full Name:</label>
    <input type="text" class="form-control" id="fullName" placeholder="Enter full name" name="name">

    @error('name')
        <p class="text-red-500 text-xs mt-1">Please enter your name</p>
    @enderror

</div>
<div class="form-group">
    <label for="phoneNo">Phone Number:</label>
    <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter phone number" name="phoneNo">

    @error('phoneNo')
        <p class="text-red-500 text-xs mt-1">Please enter your phone number</p>
    @enderror
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">

    @error('email')
        <p class="text-red-500 text-xs mt-1">Please enter a valid email address</p>
    @enderror
</div>
</div>
<div class="col-md-6" style="margin-top: 5.4rem">
    <div class="form-group">
        <label for="password">Password:</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
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
            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password"
                name="password_confirmation">
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
    <button type="submit" class="btn btn-create btn-block">Create <i class="fa fa-arrow-right"
            aria-hidden="true"></i></button>
    </form>
</div>
</div>
</div>
</x-layout>
--}}

<x-layout>
    <x-navbar />


    <div class="container">

        <div class="mt-4 mb-4">
            <p class="h2">Create New User</p>
            <p>Please fill in the following information to create a new user.</p>
        </div>

        <form method="POST" action={{ route('user.create') }} id="createUserForm">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="role">User Role <span class="form-required">*</span></label>
                    <select id="role" class="form-control" name="role" value="{{ old('role') }}">
                        <option disabled selected>Select a role</option>
                        <option value="admin" @if(old('role')==='admin' ) selected @endif>Admin</option>
                        <option value="client" @if(old('role')==='client' ) selected @endif>Client</option>
                        <option value="technician" @if(old('role')==='technician' ) selected @endif>Technician</option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password <span class="form-required">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" placeholder="Enter you password"
                            name="password">
                        <div class="input-group-append">
                            <span class="input-group-text eye-icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="name"
                        placeholder="Enter Your Full Name (e.g., Jane Doe)" name="name"
                        value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm Password <span class="form-required">*</span></label>

                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirmation"
                            placeholder="Confirm your password" name="password_confirmation">
                        <div class="input-group-append">
                            <span class="input-group-text eye-icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>

                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="email"
                        placeholder="Email address (e.g., name@example.com)" name="email"
                        value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phoneNo">Phone Number <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="phoneNo"
                        placeholder="Enter your phone number (e.g., 012-4567890)" name="phoneNo"
                        value="{{ old('phoneNo') }}">

                    @error('phoneNo')
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
