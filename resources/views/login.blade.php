<x-layout>

<x-navbar/>



{{-- Login Form --}}
<div class="container login-form">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="text-left" style="font-size: 40px">Login to Your Account</h2>
        <p class="text-left">Please login with your username and password</p>
        <div class="form-group label-left">
          <label for="email">Username:</label>
          <input type="text" class="form-control" id="username" placeholder="Enter your username" name="email">
        </div>
        
        <div class="form-group label-left">
          @error('email')
          <p class="text-red-500 text-xs mt-1">Please enter your username</p>
          @enderror
        </div>

        <div class="form-group label-left">
          <label for="password">Password:</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
            <div class="input-group-append">
              <span class="input-group-text eye-icon">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </div>

        <div class="form-group label-left">
          @error('password')
          <p class="text-red-500 text-xs mt-1" >Please enter your password</p>
          @enderror
        </div>

        
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="background-color:black">Login <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
      </form>
    </div>
  </div>
</div>

{{-- <x-flash-message /> --}}

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</x-layout>