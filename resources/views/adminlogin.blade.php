<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



  <title>Document</title>
</head>
<body>
{{-- navbar --}}
  <nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/">
      <img src="img/mycsc-logo.png" alt="Logo" width="123" height="55">
    </a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      
      <ul class="navbar-nav ml-auto navbar-right-section">

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



  {{-- Login Form --}}
  <div class="container login-form">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form>
          <h2 class="text-left" style="font-size: 40px">Login to Your Account</h2>
          <p class="text-left">Please login with your username and password</p>
          <div class="form-group label-left">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter your username">
          </div>
          <div class="form-group label-left">
            <label for="password">Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" placeholder="Enter your password">
              <div class="input-group-append">
                <span class="input-group-text eye-icon">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
              </div>
            </div>
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



</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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