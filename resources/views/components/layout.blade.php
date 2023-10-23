<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    {{-- import css and js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/layout.js', 'resources/css/star-rating.css'])

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"> --}}

    {{-- Bootstrap Select --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>


    {{-- Toastr notifications --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- bootstrap js --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> --}}

    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>


    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- DataTables Select JS -->
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>


    {{-- DataTables SearchBuilder --}}
    <script src="https://cdn.datatables.net/searchbuilder/1.5.0/js/dataTables.searchBuilder.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


    {{-- State Restore --}}
    <script src="https://cdn.datatables.net/staterestore/1.3.0/js/dataTables.stateRestore.min.js"></script>

    {{-- DataTables Responsive --}}
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    {{-- fot awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/svg-with-js.min.css" integrity="sha512-4oP5WpLD1feGamTDxyKyYjJj9a15AlPfKOt78LpGmZ+XfrUcuC7hjHVTuzhJhO4pPvi3RHL6CI2Tyjdoik3AnA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Font Awesome  --}} 
    {{-- <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> --}}

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    {{-- DataTables Buttons CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


    <!-- DataTables Select CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">

    {{-- DataTables SearchBuilder --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.5.0/css/searchBuilder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">



    {{-- DataTables State Restore --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.3.0/css/stateRestore.dataTables.min.css">


    {{-- DataTables Responsive --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css
    ">


    {{-- datepicker flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    {{-- Swiper --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.js" integrity="sha512-QokzG/B/9i5X3BYbmuyNn2ah9EiApK5KY4saOYZRCQINuB+X52ED0L3RCc/1x7YUA85qaFZ9uoB4x5SmkLGCJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.css" integrity="sha512-dGydSZpRi9eEJoxwfHfT6BF7tNoma1GQbCIonlVR4IRfdcnjvJW6dcfS2uGlRdqPRryPzesROUSjR7VDKG4TeA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <style>
        /* Override Bootstrap default primary button color */
        .btn-primary {
            background-color: #000000;
            border-color: #000000;
        }

        .btn-primary:hover {
            background-color: #2A2A2A; 
            border-color: #2A2A2A;
        }


        .btn-primary:active {
            background-color: black!important; 
            
        }

        .invalid-feedback{
            display: block;
        }

        .form-required{
            color: red;
        }
    </style>

    
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script> --}}

    <title>MyCSC@UMS</title>

    {{-- logo --}}
    <link rel="icon" href={{ asset('img/ums_logo.png') }} type="image/x-icon">
</head>

<body>


    <main>
        {{-- VIEW OUTPUT --}}
        {{ $slot }}
    </main>




{{-- Footer --}}
<footer class="page-footer pb-5">
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
        <p>More ways to reach us:&nbsp;call 05-10008000, or visit <a
                href="https://goo.gl/maps/PghhTcEvzu9qbK6x9" target="_blank">Universiti Malaysia Sabah</a></p>
        <hr>
        <div class="footer-legal">
            <div class="d-inline-block copyright">
                <p class="d-inline-block">Copyright MyCyberSecurity Clinic UMS © 2012. All Rights Reserved<br></p>
            </div>

        </div>
    </div>
    </div>
</footer>



{{-- Dynamic Title --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const routeName = '{{ Route::currentRouteName() }}';
        const titleMap = {
            'landing': 'Home',
            'login': 'Login',
            'admin.index': 'Dashboard',
            
            'admin.user.index': 'Users',
            'admin.user.create': 'Create User',
            'admin.user.edit': 'Update User', 

            'admin.service.index': 'Services',
            'admin.service.create': 'Create Service',
            'admin.service.edit': 'Update Service',  

            'admin.appointment.index': 'Appointments',
            'admin.appointment.create': 'Create Appointment',
            'admin.appointment.edit': 'Update Appointment', 
            
            'admin.order.index': 'Orders',
            'admin.order.create': 'Create Order',
            'admin.order.edit': 'Update Order',

            'admin.invoice.index': 'Invoices',
            'admin.invoice.create': 'Create Invoice',
            'admin.invoice.edit': 'Update Invoice',

            'admin.feedback.index': 'Feedbacks',
            'admin.feedback.create': 'Create Feedback',
            'admin.feedback.edit': 'Update Feedback',

            'admin.inquiry.index': 'Inquiries',
            'admin.inquiry.create': 'Create Inquiry',
            'admin.inquiry.edit': 'Update Inquiry',

            'admin.training.index': 'Trainings',
            'admin.training.create': 'Create Training',
            'admin.training.edit': 'Update Training',

            'admin.enrollment.index': 'Enrollments',
            'admin.enrollment.create': 'Create Enrollment',
            'admin.enrollment.edit': 'Update Enrollment',

            'admin.announcement.index': 'Announcements',
            'admin.announcement.create': 'Create Announcement',
            'admin.announcement.edit': 'Update Announcement',


            'client.appointment.index': 'Appointments',
            'client.order.index': 'Orders',
            'client.invoice.index': 'Invoices',
            'client.training.index': 'Trainings',
            'client.inquiry.index': 'Inquiries',
            'client.feedback.index': 'Feedbacks',

            'technician.order.index': 'Orders',
            'technician.order.edit': 'Update Order',


            'technician.service.index': 'Services',
            'technician.service.edit': 'Update Service',


            'password.edit': 'Change Password',
            'profile.edit': 'My Profile',












            



            // Add more route names and corresponding titles
        };

        const pageTitle = document.querySelector('title');
        pageTitle.innerText = 'MyCSC@UMS - ' + titleMap[routeName];
    });
</script>

{{-- password eye --}}
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


{{-- dynamic file upload name change --}}
<script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

<script>
  $('.collapse').collapse();
</script>


<script>
    $(document).ready(function () {
      $('.mark-notifications-as-read').on('click', function () {
          $.ajax({
              type: 'POST',
              url: '{{ route("mark-notifications-as-read") }}',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function () {
                  console.log('hello');
              }
          });
      });
  });
  </script>


<script>
    // Function to refresh the page
    function refreshPage() {
        location.reload();
    }

    setTimeout(refreshPage, 300000);
</script>


<x-flash-message />



</body>

</html>
