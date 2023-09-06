
<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
          <p class="h2">Schedule New Appointment</p>
          <p>Please fill in the following information to schedule an appointment.</p>
      </div>

      <form method="POST" action={{ route('user.create') }} id="createUserForm">
      @csrf
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="clientName">Client Name <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="clientName"
                      placeholder="Enter the client's full name" name="clientName" value="{{ old('clientName') }}">

                      @error('clientName')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="datetime">Date and Time <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="datetime"
                      placeholder="Select date and time for the appointment" name="datetime" value="{{ old('datetime') }}">

                      @error('datetime')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>

          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="remarks">Remarks </label>
              <input type="text" class="form-control" id="remarks"
                  placeholder="Add remarks here (optional)" name="remarks" value="{{ old('remarks') }}">

                  @error('remarks')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
          </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <br>
                  <button type="submit" class="btn btn-primary btn-block">Create <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
  </div>
</x-layout>

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
