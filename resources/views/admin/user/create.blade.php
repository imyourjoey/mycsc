<x-layout>

    <x-navbar />
    <div class="container">
        <div class="mt-4 mb-4">
            @if(session()->has('message'))
            <div class="row">
                <div class="form-group col-md-6">
                    <a href="{{ route('admin.user.index') }}">
                    <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Users</button>
                    </a>   
                </div>
            </div>
          @endif
            <p class="h2">Create New User</p>
            <p>Insert MyKad and complete the following information to create a new user. <a href="javascript:void(0)" id="manualEntryLink">Click here</a> to enter the details manually.</p>
        </div>

        <form method="POST" action={{ route('admin.user.store') }} id="createUserForm">
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
                {{-- <div class="form-group col-md-6">
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


                </div> --}}
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name <span id="retrievedMyKad"></span> <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="name"
                        placeholder="Enter Your Full Name (e.g., Jane Doe)" name="name"
                        value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="form-group col-md-6">
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

                </div> --}}
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="icNum">IC Number <span id="retrievedMyKad2"></span> <span class="form-required">*</span></label>
                    <input type="text" class="form-control" id="icNum"
                        placeholder="Please enter your IC number (without dashes '-')" name="icNum"
                        value="{{ old('icNum') }}">

                    @error('icNum')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                    <button type="submit" id="createUserButton" class="btn btn-primary btn-block">Create <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>
        </form>
    </div>

    <script>
        let shouldStopFetching = false; // Flag to control fetching

        function stopFetching() {
            shouldStopFetching = true;
            
        }

        document.getElementById('manualEntryLink').addEventListener('click', function() {
            document.getElementById('retrievedMyKad').innerText = "";
            document.getElementById('retrievedMyKad2').innerText = "";
            document.getElementById('name').value = "";
            document.getElementById('icNum').value = "";
            stopFetching(); // Stop the fetching when the link is clicked
        });

        document.getElementById('createUserButton').addEventListener('click', function() {
        stopFetching(); // Stop the fetching when the Create button is clicked
        });

        function fetchDataFromCardReader() {
            if (!shouldStopFetching) {
                fetch('/card-reader-data')
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Card data not available');
                        }
                    })
                    .then(data => {
                        if (data && data.length > 0) {
                            document.getElementById('name').value = data[0];
                            document.getElementById('retrievedMyKad').innerText = "(Retrieved from MyKad)";

                            document.getElementById('icNum').value = data[1];
                            document.getElementById('retrievedMyKad2').innerText = "(Retrieved from MyKad)";
                            // Update other fields accordingly
                        } else {
                            document.getElementById('name').value = '';
                            document.getElementById('retrievedMyKad').innerText = ''; // Clear the retrieval information
                            // Clear or reset other fields accordingly
                            document.getElementById('icNum').value = '';
                            document.getElementById('retrievedMyKad2').innerText = '';
                        }
        
                        // Call the function again after a delay if fetching is not stopped
                        if (!shouldStopFetching) {
                            setTimeout(fetchDataFromCardReader, 1000); // Schedule the next call
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        document.getElementById('name').value = '';
                        document.getElementById('retrievedMyKad').innerText = '';
                        
                        document.getElementById('icNum').value = '';
                        document.getElementById('retrievedMyKad2').innerText = '';
                        // Clear the retrieval information on error
                        // Retry the function after an error occurred if fetching is not stopped
                        if (!shouldStopFetching) {
                            setTimeout(fetchDataFromCardReader, 1000); // Schedule the next call even after an error
                        }
                    });
            } else {
                // Fetching stopped
                console.log('Fetching stopped.');
            }
        }

        // Initial call to start the fetching process
        fetchDataFromCardReader();
    </script>
        
        

</x-layout>