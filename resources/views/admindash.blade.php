<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="//unpkg.com/alpinejs" defer></script>


  
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
            
            @if (session('admin'))
                {{ session('admin')->adminName}}
            @endif  

          </a>
          <div class="dropdown-menu" aria-labelledby="loginDropdown">
            <a class="dropdown-item" href="/adminlogin">Admin</a>
            <a class="dropdown-item" href="/logout">Logout</a>
            <a class="dropdown-item" href="#">Client</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>






  <div class="card welcome-card">
    <div class="card-header">
        <h3> {{ date('d/m/Y') }}</h3>
    </div>
    <div class="card-body">
        @php
            $hour = date('G');
            if ($hour >= 5 && $hour < 12) {
                $greeting = 'Good morning';
            } elseif ($hour >= 12 && $hour < 18) {
                $greeting = 'Good afternoon';
            } else {
                $greeting = 'Good evening';
            }
        @endphp

        <h4>{{ $greeting }}, {{ session('admin')->adminName }}</h4>

        
    </div>
</div>

<div class="card m-5" style="width:30%">
  <div class="card-header">
      <h5 class="card-title">Inquiry</h5>
  </div>
  <div class="card-body d-flex flex-column align-items-center">
      <p class="card-text">Received Today: </p>
      <p><span class="badge badge-primary" style="font-size: 2rem; background-color:white; color:blue">{{ session('inquiryCount')}}</span></p>
    
  </div>
</div>



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
    <x-flash-message />
  

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>