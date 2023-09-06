{{-- <x-layout>
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
                    <label for="role">User Role</label>
                    <select id="role" class="form-control" name="role" value="{{ old('role') }}">
                        <option disabled selected >Select a role</option>
                        <option value="admin" @if(old('role') === 'admin') selected @endif>Admin</option>
                        <option value="client" @if(old('role') === 'client') selected @endif>Client</option>
                        <option value="technician" @if(old('role') === 'technician') selected @endif>Technician</option>
                    </select>

                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name"
                        placeholder="Enter Your Full Name (e.g., Jane Doe)" name="name" value="{{ old('name') }}">

                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm Password</label>

                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirmation"
                            placeholder="Confirm your password" name="password_confirmation">
                        <div class="input-group-append">
                            <span class="input-group-text eye-icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email"
                        placeholder="Email address (e.g., name@example.com)" name="email" value="{{ old('email') }}">

                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phoneNo">Phone Number</label>
                    <input type="text" class="form-control" id="phoneNo"
                        placeholder="Enter your phone number (e.g., 012-4567890)" name="phoneNo" value="{{ old('phoneNo') }}">

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
</x-layout> --}}
