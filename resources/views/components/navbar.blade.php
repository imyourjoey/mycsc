{{-- import css --}}
@vite(['resources/css/navbar.css'])

<nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
  
    

@if (request()->routeIs('landing') && !auth()->check())

<a class="navbar-brand" href="{{ route('landing') }}">
  <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
</a>

<div class="collapse navbar-collapse">
<ul class="navbar-nav ml-auto navbar-right-section">
  <li class="nav-item">
    <a class="nav-link" href="#">Service</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">News</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">Training</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">Testimonial</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="#">Inquiry</a>
  </li>

  <li class="nav-item red-rounded-square">
    <a class="nav-link" href="{{ route('login') }}">Login</a>
  </li>
</ul>
</div>

{{-- Login Form --}}
@elseif (request()->routeIs('login') && !auth()->check())  

<a class="navbar-brand" href="{{ route('landing') }}">
  <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
</a>

<div class="collapse navbar-collapse">
<ul class="navbar-nav ml-auto navbar-right-section">

  <li class="nav-item red-rounded-square">
    <a class="nav-link" href="{{ route('landing') }}">Back</a>
  </li>
</ul>
</div>


{{-- Admin Dashboard --}}
@elseif(auth()->check() && auth()->user()->role === 'admin')

<a class="navbar-brand" href={{ route('admin.index') }}>
  <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
</a>

<div class="collapse navbar-collapse">
<ul class="navbar-nav ml-auto navbar-right-section">

  
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Users</a>
      <a class="dropdown-item" href="{{ route('user.show-create') }}">Create User</a>
  </div>
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
  <a class="nav-link dropdown-toggle" href="#" id="logoutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
    {{ auth()->user()->name }}

  </a>
  <div class="dropdown-menu" aria-labelledby="logoutDropdown">
    <a class="dropdown-item" href="/">My Profile</a>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
  </div>
</li>
</ul>
</div>

@endif

  </div>
</nav>


{{-- Dropdown Menu --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



