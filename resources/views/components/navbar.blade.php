{{-- import css --}}
@vite(['resources/css/navbar.css'])



<nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    

@if ((!request()->routeIs('login') && !request()->routeIs('showGuestAppointment') &&!request()->routeIs('showGuestAppointmentForm')) && !auth()->check())

<a class="navbar-brand" href="{{ route('landing') }}">
  
  <div class="row align-items-center">

  <div class="col pr-0">
    <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
  </div>

  <div class="col pr-2 pl-0">
    <div class="h2">@</div>
  </div>

  <div class="col pl-1">
    <img src="{{ asset('img/ums-logo.png') }}" alt="Logo" width="80" height="37">
  </div>
  </div>


</a>

<div class="collapse navbar-collapse" id="navbarToggler">
    <ul class="navbar-nav ml-auto navbar-right-section">
        <li class="nav-item">
            <a class="nav-link smooth-scroll" href="#" data-section="service-section">Service</a>
        </li>

        <li class="nav-item">
            <a class="nav-link smooth-scroll" href="#" data-section="news-section">News</a>
        </li>

        <li class="nav-item">
            <a class="nav-link smooth-scroll" href="#" data-section="training-section">Training</a>
        </li>

        <li class="nav-item">
            <a class="nav-link smooth-scroll" href="#" data-section="testimonial-section">Testimonial</a>
        </li>

        <li class="nav-item">
            <a class="nav-link smooth-scroll" href="#" data-section="inquiry-section">Inquiry</a>
        </li>

        <li class="nav-item red-rounded-square">
            <a class="nav-link nav-link-black" href="{{ route('login') }}">Login</a>
        </li>
    </ul>
</div>

{{-- Login Form --}}
@elseif ((request()->routeIs('login') || request()->routeIs('showGuestAppointment') ||request()->routeIs('showGuestAppointmentForm')) && !auth()->check())  

<a class="navbar-brand" href="{{ route('landing') }}">
  <div class="row align-items-center">

    <div class="col pr-0">
      <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
    </div>
  
    <div class="col pr-2 pl-0">
      <div class="h2">@</div>
    </div>
  
    <div class="col pl-1">
      <img src="{{ asset('img/ums-logo.png') }}" alt="Logo" width="85" height="37">
    </div>
    </div>
</a>

<div class="collapse navbar-collapse" id="navbarToggler">
    <ul class="navbar-nav ml-auto navbar-right-section">

        <li class="nav-item red-rounded-square">
            <a class="nav-link nav-link-black" href="{{ route('landing') }}">Back</a>
        </li>
    </ul>
</div>


{{-- Admin Dashboard --}}
@elseif(auth()->check() && auth()->user()->role === 'admin')

<a class="navbar-brand" href={{ route('admin.index') }}>
  <div class="row align-items-center">

    <div class="col pr-0">
      <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
    </div>
  
    <div class="col pr-2 pl-0">
      <div class="h2">@</div>
    </div>
  
    <div class="col pl-1">
      <img src="{{ asset('img/ums-logo.png') }}" alt="Logo" width="85" height="37">
    </div>
    </div>
</a>

<div class="collapse navbar-collapse" id="navbarToggler">
<ul class="navbar-nav ml-auto navbar-right-section">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.user.index') }}">User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.service.index') }}">Service</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.appointment.index') }}">Calendar</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.order.index') }}">Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.invoice.index') }}">Invoice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.feedback.index') }}">Feedback</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.inquiry.index') }}">Inquiry</a>
  </li>




  <li class="nav-item dropdown">
    <a class="nav-link" href="#" id="trainingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Training</a>

    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="trainingDropdown">
      <a class="dropdown-item" href="{{ route('admin.training.index') }}">Programs</a>
      <a class="dropdown-item" href="{{ route('admin.enrollment.index') }}">Enrollments</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.announcement.index') }}">News</a>
  </li>
  <li class="nav-item ml-1 mr-1">
    <a class="nav-link mark-notifications-as-read" href="#" data-toggle="modal" data-target="#notificationModal">
     
        
      <span class="fa-layers fa-fw ">
        <i class="fa fa-bell h4"></i>
        @if ($unreadNotificationCount > 0)
        <span class="fa-layers-counter" style="background:#871719;" ><p class="h1">{{ $unreadNotificationCount }}</p></span>
      </span> 
      @endif       
    </a>
      
      
      
  </li>
<li class="nav-item dropdown red-rounded-square mr-3">
  <a class="nav-link dropdown-toggle nav-link-black" href="#" id="logoutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
    {{ explode(' ', auth()->user()->name)[0] }}

  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutDropdown">
    <a class="dropdown-item" href="{{ route('password.edit') }}">Change Password</a>
    <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
  </div>
</li>
</ul>
</div>

{{-- Client Dashboard --}}
@elseif(auth()->check() && auth()->user()->role === 'client')

<a class="navbar-brand" href={{ route('client.index') }}>
  <div class="row align-items-center">

    <div class="col pr-0">
      <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
    </div>
  
    <div class="col pr-2 pl-0">
      <div class="h2">@</div>
    </div>
  
    <div class="col pl-1">
      <img src="{{ asset('img/ums-logo.png') }}" alt="Logo" width="85" height="37">
    </div>
    </div>
</a>

<div class="collapse navbar-collapse" id="navbarToggler">
<ul class="navbar-nav ml-auto navbar-right-section">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('client.appointment.index') }}">Appointment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('client.order.index') }}">Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('client.invoice.index') }}">Invoice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('client.enrollment.index') }}">Training</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('client.inquiry.index') }}">Inquiry</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('client.feedback.index') }}">Feedback</a>
  </li>
  <li class="nav-item ml-1 mr-1">
    <a class="nav-link mark-notifications-as-read" href="#" data-toggle="modal" data-target="#notificationModal">
     
        
      <span class="fa-layers fa-fw ">
        <i class="fa fa-bell h4"></i>
        @if ($unreadNotificationCount > 0)
        <span class="fa-layers-counter" style="background:#871719;" ><p class="h1">{{ $unreadNotificationCount }}</p></span>
      </span> 
      @endif       
    </a>
      
      
      
  </li>
  
<li class="nav-item dropdown red-rounded-square mr-3">
  <a class="nav-link dropdown-toggle nav-link-black" href="#" id="logoutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
    {{ explode(' ', auth()->user()->name)[0] }}

  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutDropdown">
    <a class="dropdown-item" href="{{ route('password.edit') }}">Change Password</a>
    <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
  </div>
</li>
</ul>
</div>

{{-- Technician Dashboard --}}
@elseif(auth()->check() && auth()->user()->role === 'technician')

<a class="navbar-brand" href={{ route('technician.index') }}>
  <div class="row align-items-center">

    <div class="col pr-0">
      <img src="{{ asset('img/mycsc-logo.png') }}" alt="Logo" width="123" height="55">
    </div>
  
    <div class="col pr-2 pl-0">
      <div class="h2">@</div>
    </div>
  
    <div class="col pl-1">
      <img src="{{ asset('img/ums-logo.png') }}" alt="Logo" width="85" height="37">
    </div>
    </div>
</a>

<div class="collapse navbar-collapse" id="navbarToggler">
<ul class="navbar-nav ml-auto navbar-right-section">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('technician.order.index') }}">Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('technician.service.index') }}">Service</a>
  </li>
  <li class="nav-item ml-1 mr-1">
    <a class="nav-link mark-notifications-as-read" href="#" data-toggle="modal" data-target="#notificationModal">
     
        
      <span class="fa-layers fa-fw ">
        <i class="fa fa-bell h4"></i>
        @if ($unreadNotificationCount > 0)
        <span class="fa-layers-counter" style="background:#871719;" ><p class="h1">{{ $unreadNotificationCount }}</p></span>
      </span> 
      @endif       
    </a>
      
      
      
  </li>
<li class="nav-item dropdown red-rounded-square mr-3">
  <a class="nav-link dropdown-toggle nav-link-black" href="#" id="logoutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
    {{-- {{ auth()->user()->name }} --}}
    {{ explode(' ', auth()->user()->name)[0] }}

  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutDropdown">
    <a class="dropdown-item" href="{{ route('password.edit') }}">Change Password</a>
    <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>

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

<x-notification-modal/>











