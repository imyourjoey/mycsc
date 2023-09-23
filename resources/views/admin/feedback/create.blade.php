
<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
        @if(session()->has('message'))
        <div class="row">
            <div class="form-group col-md-6">
                <a href="{{ route('admin.feedback.index') }}">
                <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Feedbacks</button>
                </a>   
            </div>
        </div>
      @endif
          <p class="h2">Share Your Feedback!</p>
          <p>Please fill in the following information and share your valuable insights</p>
      </div>

      <form method="POST" action={{ route('admin.feedback.store') }} id="createUserForm">
      @csrf
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="feedbackMessage">Your Feedback/Message <span class="form-required">*</span></label>
                  <textarea type="text" rows="4" class="form-control" id="feedbackMessage"
                      placeholder="Please share your detailed feedback here. We appreciate your input." name="feedbackMessage" value="{{ old('feedbackMessage') }}"></textarea>

                      @error('feedbackMessage')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>
          </div>

          <div class="row">
            <div class="form-group mb-0 col-md-6">
                <label>Rate Your Experience with Us! <span class="form-required">*</span></label>
                <div class="rating w-50 m-0">
                    <input type="radio" name="rating" value="5" id="rating5" @if(old('rating') == '5') checked @endif><label class="m-0" for="rating5">☆</label>
                    <input type="radio" name="rating" value="4" id="rating4" @if(old('rating') == '4') checked @endif><label class="m-0" for="rating4">☆</label>
                    <input type="radio" name="rating" value="3" id="rating3" @if(old('rating') == '3') checked @endif><label class="m-0" for="rating3">☆</label>
                    <input type="radio" name="rating" value="2" id="rating2" @if(old('rating') == '2') checked @endif><label class="m-0" for="rating2">☆</label>
                    <input type="radio" name="rating" value="1" id="rating1" @if(old('rating') == '1') checked @endif><label for="rating1">☆</label>
                </div>

                @error('rating')
                      <div class="invalid-feedback mb-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        

          <div class="row">
              <div class="form-group col-md-6 mt-2">
                  <button type="submit" class="btn btn-primary btn-block">Submit <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
  </div>

  
</x-layout>
