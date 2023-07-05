<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
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
                            <input type="text" class="form-control" id="inquiryName" name="inquiryName" value="{{ $inquiry->inquiryName }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryMessage" class="col-sm-3 col-form-label">Inquiry Message:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="inquiryMessage" name="inquiryMessage" readonly>{{ $inquiry->inquiryMessage }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryReply" class="col-sm-3 col-form-label">Inquiry Reply:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="inquiryReply" name="inquiryReply" readonly>{{ $inquiry->inquiryReply }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inquiryContactEmail" class="col-sm-3 col-form-label">Inquiry Contact Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inquiryContactEmail" name="inquiryContactEmail" value="{{ $inquiry->inquiryContactEmail }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="row mt-3">
                <div class="col-lg-12">
                    <button type="button" onclick="window.location.href ='/inquirydatatable';"class="btn btn-secondary" style="margin-left: 8%;width: 20%">Back</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
