
<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
          <p class="h2">Share Your Feedback!</p>
          <p>Please fill in the following information and share your valuable insights</p>
      </div>

      <form method="POST" action={{ route('user.create') }} id="createUserForm">
      @csrf
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="feedbackMessage">Your Feedback/Message <span class="form-required">*</span></label>
                  <textarea type="text" rows="4" class="form-control" id="feedbackMessage"
                      placeholder="Please share your detailed feedback here. We appreciate your input" name="feedbackMessage" value="{{ old('feedbackMessage') }}"></textarea>

                      @error('feedbackMessage')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>
          </div>

          <div class="row ">
              <div class="form-group mb-0 col-md-6">
                  <label>Rate Your Experience with Us! <span class="form-required">*</span></label>
                  <div class="rating">

                    <input type="radio" name="rating" value="5" id="rating5" ><label for="rating5">☆</label>
                    <input type="radio" name="rating" value="4" id="rating4" ><label for="rating4">☆</label>
                    <input type="radio" name="rating" value="3" id="rating3" ><label for="rating3">☆</label>
                    <input type="radio" name="rating" value="2" id="rating2" ><label for="rating2">☆</label>
                    <input type="radio" name="rating" value="1" id="rating1" ><label for="rating1">☆</label>
                  </div>
              </div>

          </div>

          <div class="row">
              <div class="form-group col-md-6 mt-1">
                  <button type="submit" class="btn btn-primary btn-block">Submit <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>

              </div>
          </div>
      </form>
  </div>

  
</x-layout>
