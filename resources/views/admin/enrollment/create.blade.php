<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
          <p class="h2">Enrol in a Training Programme!</p>
          <p>Please fill in the following information to enroll to a training programme.</p>
      </div>

      <form method="POST" id="createEnrollmentForm" action=" {{ route('admin.enrollment.store') }}">
          @csrf
          <div class="row">
            
                <div class="form-group col-md-6">
                    <label for="trainingTitle">Training Title<span class="form-required">*</span></label>
                    <select class="selectpicker form-control border bg-white" id="trainingTitle" data-live-search="true" name="trainingTitle">
                        <option disabled selected>-Select Training Program-</option>
                        @foreach ($trainings as $training)
                        <option value="{{ $training->trainingTitle }}" @if(old('trainingTitle')=== $training->trainingTitle ) selected @endif>{{ $training->trainingTitle }}</option>
                      @endforeach
                      </select>


                    @error('trainingTitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
          

          </div>

          <div class="row">
            <div class="form-group col-md-6">
                <label for="userTag" class="m-0">Client ID<span class="form-required">*</span></label>
                <select class="selectpicker form-control border bg-white" id="userTag" data-live-search="true" name="userTag">
                    <option disabled selected>-Select Client ID-</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->userTag }}" @if(old('userTag')=== $user->userTag ) selected @endif>{{ $user->userTag }} - {{ $user->name }}</option>
                  @endforeach
                  </select>


                @error('userTag')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

          </div>


          <div class="row">
              <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-primary btn-block">Enroll <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
  </div>
</x-layout>
