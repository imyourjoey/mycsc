  <x-layout>
    <x-navbar />
  
  
    <div class="container">
  
        <div class="mt-4 mb-4">
          @if(session()->has('message'))
          <div class="row">
              <div class="form-group col-md-6">
                  <a href="{{ route('admin.enrollment.index') }}">
                  <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Enrollments</button>
                  </a>   
              </div>
          </div>
        @endif
            <p class="h2">Edit a Training Enrollment</p>
            <p>Please fill in the following information to update enrollment information.</p>
        </div>
  
        <form method="POST" id="editEnrollmentForm" action=" {{ route('admin.enrollment.update',['enrollment' => $enrollment->enrollmentID]) }}">
            @csrf
            @method('PUT')


            <div class="row">
              <div class="form-group col-md-6">
                  <label for="enrollmentID">Enrollment ID</label>
                  <input type="text" class="form-control" id="enrollmentID" name="enrollmentID" value="{{ old('enrollmentID', $enrollment->enrollmentID) }}" readonly>
                  
                  @error('enrollmentID')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="userTag">User Tag</label>
                  @if ($enrollment->userTag !== null)
                  <input type="text" class="form-control" id="userTag" name="userTag" value="{{ old('userTag', $enrollment->userTag) }}" readonly>
                  @else
                  <input type="text" class="form-control" id="userTag" name="userTag" value="N/A" readonly>
                  @endif
                  
                  @error('userTag')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="trainingTitle">Training Title</label>
                  <input type="text" class="form-control" id="trainingTitle" name="trainingTitle" value="{{ old('trainingTitle', $training->trainingTitle) }}" readonly>
                  
                  @error('trainingID')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="applicantName">Applicant Name</label>
                  <input type="text" class="form-control" id="applicantName" name="applicantName" value="{{ old('applicantName', $enrollment->applicantName) }}" readonly>
                  
                  @error('applicantName')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="applicantEmail">Applicant Email</label>
                  <input type="text" class="form-control" id="applicantEmail" name="applicantEmail" value="{{ old('applicantEmail', $enrollment->applicantEmail) }}" readonly>
                  
                  @error('applicantEmail')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="applicantContact">Applicant Contact</label>
                  <input type="text" class="form-control" id="applicantContact" name="applicantContact" value="{{ old('applicantContact', $enrollment->applicantContact) }}" readonly>
                  
                  @error('applicantContact')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          
          <div class="row">
            <div class="form-group col-md-6">
                <label for="enrollStatus" class="m-0">Enroll Status<span class="form-required">*</span></label>
                <select class="selectpicker form-control border bg-white" id="enrollStatus" name="enrollStatus">
                    <option value="Pending" @if(old('enrollStatus', $enrollment->enrollStatus) === 'Pending') selected @endif>Pending</option>
                    <option value="Approved" @if(old('enrollStatus', $enrollment->enrollStatus) === 'Approved') selected @endif>Approved</option>
                </select>
        
                @error('enrollStatus')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        
        
        
        
        
          

            
          


  
  
            <div class="row">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Update <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>
  
                </div>
            </div>
        </form>
    </div>
  </x-layout>
