
@if (!auth()->check())
  {{-- Footer --}}
<footer class="page-footer">
  <div class="container">
      <div class="row">
          <div class="col-6 col-md-3">
              <h4>Quick Links</h4>
              <ul class="footer-links">
                  <li><a href="#" class="smooth-scroll" data-section="service-section">Service</a></li>
                  <li><a href="#" class="smooth-scroll" data-section="news-section">News</a></li>
                  <li><a href="#" class="smooth-scroll" data-section="training-section">Training</a></li>
                  <li><a href="#" class="smooth-scroll" data-section="testimonial-section">Testimonial</a></li>
                  <li><a href="#" class="smooth-scroll" data-section="inquiry-section">Inquiry</a></li>
              </ul>
          </div>
          {{-- <div class="col-6 col-md-3">
              <h4>Login</h4>
              <ul class="footer-links">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">Client</a></li>
                  <li><a href="#">Technician</a></li>

              </ul>

          </div> --}}
          <div class="col-6 col-md-3">

              <h4>Socials</h4>
              <ul class="footer-links">
                  <li><a href="#">Facebook </a></li>
                  <li><a href="#">Instagram </a></li>
                  <li><a href="#">Twitter</a></li>
              </ul>
          </div>
      </div>
      <p>More ways to reach us:&nbsp;call 05-10008000, or visit <a
              href="https://goo.gl/maps/PghhTcEvzu9qbK6x9" target="_blank" style="color: #ff7900">Universiti Malaysia Sabah</a></p>
      <hr>
      <div class="footer-legal">
          <div class="d-inline-block copyright">
              <p class="d-inline-block">Copyright MyCyberSecurity Clinic UMS © 2012. All Rights Reserved<br></p>
          </div>

      </div>
  </div>
  </div>
</footer>
@elseif (auth()->check() && auth()->user()->role === 'admin')
<footer class="page-footer">
  <div class="container">
    <div class="row">
    <div class="col-9">
      <h4>Quick Links</h4>
      <div class="row">
          <div class="col-6 col-md-4">
              <ul class="footer-links">
                  <li><a href="{{ route('admin.index') }}">Home</a></li>
                  <li><a href="{{ route('admin.user.index') }}">User</a></li>
                  <li><a href="{{ route('admin.service.index') }}">Service</a></li>
                  <li><a href="{{ route('admin.appointment.index') }}">Calendar</a></li>
              </ul>
          </div>
          <div class="col-6 col-md-4">
              <ul class="footer-links">
                  <li><a href="{{ route('admin.order.index') }}">Order</a></li>
                  <li><a href="{{ route('admin.inquiry.index') }}">Inquiry</a></li>
                  <li><a href="{{ route('admin.invoice.index') }}">Invoice</a></li>
                  <li><a href="{{ route('admin.feedback.index') }}">Feedback</a></li>


              </ul>
          </div>
          <div class="col-6 col-md-4">
              <ul class="footer-links">
                  <li><a href="{{ route('admin.announcement.index') }}">News</a></li>
                  <li><a href="{{ route('admin.training.index') }}">Training</a></li>
                  <li><a href="{{ route('admin.enrollment.index') }}">Enrollment</a></li>

              </ul>

          </div>
    </div>


    </div>


    <div class="col-3">
      <h4>Socials</h4>
      <div class="row">
        <div class="col-6 col-md-12">

 
          <ul class="footer-links">
              <li><a href="#">Facebook </a></li>
              <li><a href="#">Instagram </a></li>
              <li><a href="#">Twitter</a></li>
          </ul>
      </div>
      </div>

    </div>





      </div>
      <p>More ways to reach us:&nbsp;call 05-10008000, or visit <a
              href="https://goo.gl/maps/PghhTcEvzu9qbK6x9" target="_blank" style="color: #ff7900">Universiti Malaysia Sabah</a></p>
      <hr>
      <div class="footer-legal">
          <div class="d-inline-block copyright">
              <p class="d-inline-block">Copyright MyCyberSecurity Clinic UMS © 2012. All Rights Reserved<br></p>
          </div>

      </div>
  </div>
  </div>
</footer>

@elseif (auth()->check() && auth()->user()->role === 'client')
<footer class="page-footer">
  <div class="container">
    <div class="row">
    <div class="col-6">
      <h4>Quick Links</h4>
      <div class="row">
          <div class="col-6 col-md-6">
              <ul class="footer-links">
                  <li><a href="{{ route('client.index') }}">Home</a></li>
                  <li><a href="{{ route('client.invoice.index') }}">Invoice</a></li>
                  <li><a href="{{ route('client.enrollment.index') }}">Training</a></li>
                  <li><a href="{{ route('client.appointment.index') }}">Appointment</a></li>
              </ul>
          </div>
          <div class="col-6 col-md-6">
              <ul class="footer-links">
                <li><a href="{{ route('client.order.index') }}">Order</a></li>
                  <li><a href="{{ route('client.inquiry.index') }}">Inquiry</a></li>
                  <li><a href="{{ route('client.feedback.index') }}">Feedback</a></li>
              </ul>

          </div>
    </div>


    </div>


    <div class="col-3">
      <h4>Socials</h4>
      <div class="row">
        <div class="col-6 col-md-12">

 
          <ul class="footer-links">
              <li><a href="#">Facebook </a></li>
              <li><a href="#">Instagram </a></li>
              <li><a href="#">Twitter</a></li>
          </ul>
      </div>
      </div>

    </div>

      </div>
      <p>More ways to reach us:&nbsp;call 05-10008000, or visit <a
              href="https://goo.gl/maps/PghhTcEvzu9qbK6x9" target="_blank" style="color: #ff7900">Universiti Malaysia Sabah</a></p>
      <hr>
      <div class="footer-legal">
          <div class="d-inline-block copyright">
              <p class="d-inline-block">Copyright MyCyberSecurity Clinic UMS © 2012. All Rights Reserved<br></p>
          </div>

      </div>
  </div>
  </div>
</footer>

@elseif (auth()->check() && auth()->user()->role === 'technician')
<footer class="page-footer">
  <div class="container">
    <div class="row">
    <div class="col-4">
      <h4>Quick Links</h4>
      <div class="row">
          <div class="col-6 col-md-12">
              <ul class="footer-links">
                  <li><a href="{{ route('technician.index') }}">Home</a></li>
                  <li><a href="{{ route('technician.order.index') }}">Order</a></li>
                <li><a href="{{ route('technician.service.index') }}">Service</a></li>

              </ul>
          </div>
    </div>


    </div>


    <div class="col-3">
      <h4>Socials</h4>
      <div class="row">
        <div class="col-6 col-md-12">

 
          <ul class="footer-links">
              <li><a href="#">Facebook </a></li>
              <li><a href="#">Instagram </a></li>
              <li><a href="#">Twitter</a></li>
          </ul>
      </div>
      </div>

    </div>

      </div>
      <p>More ways to reach us:&nbsp;call 05-10008000, or visit <a
              href="https://goo.gl/maps/PghhTcEvzu9qbK6x9" target="_blank" style="color: #ff7900">Universiti Malaysia Sabah</a></p>
      <hr>
      <div class="footer-legal">
          <div class="d-inline-block copyright">
              <p class="d-inline-block">Copyright MyCyberSecurity Clinic UMS © 2012. All Rights Reserved<br></p>
          </div>

      </div>
  </div>
  </div>
</footer>
@endif