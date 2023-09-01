<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    {{-- import css and js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    {{-- fot awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

{{--     
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /> --}}
  
    

    

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



{{-- Dynameic Title --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const routeName = '{{ Route::currentRouteName() }}';
        const titleMap = {
            'landing': 'Home',
            'login': 'Login',
            'admin.index': 'Dashboard',
            'admin.createUserForm': 'Create User'

            // Add more route names and corresponding titles
        };

        const pageTitle = document.querySelector('title');
        pageTitle.innerText = 'MyCSC@UMS - ' + titleMap[routeName];
    });
</script>


{{-- Dropdown Menu --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

{{-- Toastr notifications --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>


<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>


<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script> --}}


<x-flash-message />

</body>

</html>
