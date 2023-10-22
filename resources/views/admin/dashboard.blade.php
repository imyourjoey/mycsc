<x-layout>
<x-navbar/>

<x-welcome-message />
<div class="container-fluid">
<div class="row ml-1 mr-1 mb-3">
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Appointment</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 text-center">
                        <p>Scheduled Today</p>
                        <p><span class="h2 font-weight-bold">{{ $scheduledAppointmentCount }}</span></p>
  
                    </div>
                    <div class="col-4 text-center">
                        <p>Requested Today</p>
                        <p><span class="h2 font-weight-bold">{{ $requestedAppointmentCount }}</span></p>
                        
                    </div>
                    <div class="col-4 text-center">
                        <p>Unapproved</p>
                        <p><span class="h2 font-weight-bold">{{ $unapprovedAppointmentCount }}</span></p>
                    </div>
                </div>

                </div>
            </div>
        </div>


        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Revenue</h5>
                </div>
                <div class="card-body text-center">
                    <p>Month-To-Date</p>
                    <p><span class="h2 font-weight-bold">RM{{ $totalPaymentAmount }}</span></p>
                    
                </div>
        </div>
    </div>
</div>


<div class="row mt-5 ml-1 mr-1">
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Training</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 text-center">
                        <p>Scheduled Today</p>
                        <p><span class="h2 font-weight-bold">{{ $scheduledTrainingCount }}</span></p>
  
                    </div>
                    <div class="col-4 text-center">
                        <p>Enrolled Today</p>
                        <p><span class="h2 font-weight-bold">{{ $enrollmentCount }}</span></p>
                        
                    </div>
                    <div class="col-4 text-center">
                        <p>Unapproved</p>
                        <p><span class="h2 font-weight-bold">{{ $unapprovedEnrollmentCount }}</span></p>
                    </div>
                </div>

                </div>
            </div>
        </div>


        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Revenue</h5>
                </div>
                <div class="card-body text-center">
                    <p>Today</p>
                    <p><span class="h2 font-weight-bold">RM{{ $totalPaymentAmountToday }}</span></p>
                    
                </div>
        </div>
    </div>
</div>

<div class="row mt-5 ml-1 mr-1">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Inquiry</h5>
            </div>
            <div class="card-body text-center">
                <p>Received Today</p>
                <p><span class="h2 font-weight-bold">{{ $inquiryCount }}</span></p>
                
            </div>
    </div>
</div>
<div class="col-3">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Feedback</h5>
        </div>
        <div class="card-body text-center">
            <p>Received Today</p>
            <p><span class="h2 font-weight-bold">{{ $feedbackCount }}</span></p>
            
        </div>
</div>
</div>
</div>
</div>




</x-layout>