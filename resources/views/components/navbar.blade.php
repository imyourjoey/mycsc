{{-- import css --}}
@vite(['resources/css/navbar.css'])

<nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    

@if (!request()->routeIs('login') && !auth()->check())

<a class="navbar-brand" href="{{ route('landing') }}">
  <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
</a>

<div class="collapse navbar-collapse" id="navbarToggler">
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

<div class="collapse navbar-collapse" id="navbarToggler">
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

<div class="collapse navbar-collapse" id="navbarToggler">
<ul class="navbar-nav ml-auto navbar-right-section">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Users</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create User</a>
  </div>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Service</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Services</a>
      <a class="dropdown-item" href="{{ route('service.create') }}">Create Service</a>
  </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Calendar</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Order</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Orders</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create Order</a>
  </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Invoice</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Invoices</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create Invoice</a>
  </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Feedback</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Feedback</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create Feedback</a>
  </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inquiry</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Inquiries</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create Inquiries</a>
  </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Training</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Training Programmes</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create Training Programmes</a>
  </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News</a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('user.index') }}">Manage Announcements</a>
      <a class="dropdown-item" href="{{ route('user.create') }}">Create Announcement</a>
  </div>
  </li>
<li class="nav-item dropdown red-rounded-square mr-3">
  <a class="nav-link dropdown-toggle" href="#" id="logoutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
    {{-- {{ auth()->user()->name }} --}}
    {{ explode(' ', auth()->user()->name)[0] }}

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




