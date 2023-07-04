<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <form action="/inquiries/update" method="POST">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inquiryID">Inquiry ID:</label>
                    </div>
                    <div class="form-group">
                        <label for="clientID">Client ID:</label>
                    </div>
                    <div class="form-group">
                        <label for="inquiryName">Inquiry Name:</label>
                    </div>
                    <div class="form-group">
                        <label for="inquiryMessage">Inquiry Message:</label>
                    </div>
                    <div class="form-group">
                        <label for="inquiryReply">Inquiry Reply:</label>
                    </div>
                    <div class="form-group">
                        <label for="inquiryContactEmail">Inquiry Contact Email:</label>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inquiryID" name="inquiryID">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="clientID" name="clientID">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inquiryName" name="inquiryName">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="inquiryMessage" name="inquiryMessage"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="inquiryReply" name="inquiryReply"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="inquiryContactEmail" name="inquiryContactEmail">
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
