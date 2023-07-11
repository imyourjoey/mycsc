<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>MyCSC@UMS</title>
    <link rel = "icon" href = {{ asset('img/ums_logo.png')}} type = "image/x-icon">

</head>

<body>

    
  <nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/">
      <img src="{{asset('img/mycsc-logo.png')}}" alt="Logo" width="123" height="55">
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





    <div class="container update-inquiry-form">
        <form action="/inquiry/{{ $inquiry->inquiryID }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-10 offset-md-1">
                    <div class="form-group row">
                        <label for="inquiryID" class="col-sm-3 col-form-label">Inquiry ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inquiryID" name="inquiryID" value="{{ $inquiry->inquiryID }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clientID" class="col-sm-3 col-form-label">Client ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="clientID" name="clientID" value="{{ $inquiry->clientID }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryName" class="col-sm-3 col-form-label">Inquiry Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inquiryName" name="inquiryName" value="{{ $inquiry->inquiryName }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryMessage" class="col-sm-3 col-form-label">Inquiry Message:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="inquiryMessage" name="inquiryMessage">{{ $inquiry->inquiryMessage }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryReply" class="col-sm-3 col-form-label">Inquiry Reply:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="inquiryReply" name="inquiryReply">{{ $inquiry->inquiryReply }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryContactEmail" class="col-sm-3 col-form-label">Inquiry Contact Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inquiryContactEmail" name="inquiryContactEmail" value="{{ $inquiry->inquiryContactEmail }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="row mt-3">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary" style="margin-left: 8%;width: 20%">Update Changes</button>
                    <button type="button" onclick="window.location.href ='/inquirydatatable';"class="btn btn-secondary" style="margin-left:2% ;width: 20%">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
