<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">



  
<script>
  function updateFormAction() {
    var form = document.getElementById("createUserForm");
    var userRole = document.getElementById("userRole").value;

    if (userRole === "client") {
      form.action = "/client"; // Update the action link for the "client" role
    } else if (userRole === "technician") {
      form.action = "/technician"; // Update the action link for the "technician" role
    } else if (userRole === "admin") {
      form.action = "/admin"; // Update the action link for the "admin" role
    }
  }
</script>

  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])





  <title>Document</title>
</head>
<body>
  
  <nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/">
      <img src="img/mycsc-logo.png" alt="Logo" width="123" height="55">
    </a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      
      <ul class="navbar-nav ml-auto navbar-right-section">
        <li class="nav-item">
          <a class="nav-link" href="#">User</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Calendar</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Service</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Order</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Invoice</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Feedback</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Inquiry</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Training</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#">News</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Report</a>
        </li>



        <li class="nav-item dropdown red-rounded-square">
          <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Login
          </a>
          <div class="dropdown-menu" aria-labelledby="loginDropdown">
            <a class="dropdown-item" href="/adminlogin">Admin</a>
            <a class="dropdown-item" href="#">Technician</a>
            <a class="dropdown-item" href="#">Client</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>



    {{-- create new user form --}}
      <div class="container text-left create-user-form">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <form method="POST" action="/admin" id="createUserForm">
              @csrf
              <div>
                <h2 class="text-left">Create New User</h2>
                <p class="text-left">Please fill in the following information to create a new user.</p>
              </div>
              <div class="form-group">
                <label for="userRole">User Role:</label>
                <select name="role" class="form-control" id="userRole" onchange="updateFormAction()">
                  <option  value="" disabled selected>Select a role</option>
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
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="adminUsername">

                @error('adminUsername')
                  <p class="text-red-500 text-xs mt-1">Please enter a unique username</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" class="form-control" id="fullName" placeholder="Enter full name" name="adminName">

                @error('adminUsername')
                <p class="text-red-500 text-xs mt-1">Please enter your name</p>
                @enderror

              </div>
              <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter phone number" name="adminPhone">

                @error('adminPhone')
                <p class="text-red-500 text-xs mt-1">Please enter your phone number</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="adminEmail">

                @error('adminEmail')
                <p class="text-red-500 text-xs mt-1">Please enter a valid email address</p>
                @enderror
              </div>
            </div>
            <div class="col-md-6" style="margin-top: 5.4rem">
              <div class="form-group">
                <label for="password">Password:</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="Enter password" name="adminPassword">
                  <div class="input-group-append">
                    <span class="input-group-text eye-icon">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                @error('adminPassword')
                <p class="text-red-500 text-xs mt-1">Please enter a matching password</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" name="adminPassword_confirmation">
                  <div class="input-group-append">
                    <span class="input-group-text eye-icon">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  @error('adminPassword_confirmation')
                  <p class="text-red-500 text-xs mt-1">{{ message }}</p>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-create btn-block">Create <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </form>
          </div>
        </div>
      </div>

<x-flash-message />
</body>

{{-- Footer --}}
<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col-6 col-md-3">
        <h4>Quick Links</h4>
        <ul class="footer-links">
          <li><a href="#">Home</a></li>
          <li><a href="#">Service</a></li>
          <li><a href="#">News</a></li>
          <li><a href="#">Training</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-3">
        <h4>Services</h4>
        <ul class="footer-links">
          <li><a href="#">Data Sanitisation</a></li>
          <li><a href="#">Data Recovery</a></li>
          <li><a href="#">Data Disposal</a></li>

          
        </ul>
      </div>
      <div class="col-6 col-md-3">
        <h4>Accounts</h4>
        <ul class="footer-links">
          <li><a href="#">Admin</a></li>
          <li><a href="#">Client</a></li>
          <li><a href="#">Technician</a></li>

        </ul>

      </div>
      <div class="col-6 col-md-3">
        
        <h4>Socials</h4>
        <ul class="footer-links">
          <li><a href="#">Facebook </a></li>
          <li><a href="#">Instagram </a></li>
          <li><a href="#">Twitter</a></li>
        </ul>
      </div>
    </div>
    <p>More ways to reach us:&nbsp;call 05-10008000, or visit <a href="https://goo.gl/maps/PghhTcEvzu9qbK6x9">Universiti Malaysia Sabah</a></p>
    <hr>
    <div class="footer-legal">
      <div class="d-inline-block copyright">
        <p class="d-inline-block">Copyright MyCyberSecurity UMS © 2012. All rights reserved<br></p>
      </div>

    </div>
  </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      $(".eye-icon").click(function() {
        var passwordInput = $(this).closest(".input-group").find("input");
        var icon = $(this).find("i");
        if (passwordInput.attr("type") === "password") {
          passwordInput.attr("type", "text");
          icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
          passwordInput.attr("type", "password");
          icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
      });
    });
  </script>


</html>