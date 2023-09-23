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
          <p class="h2">Edit Feedback</p>
          <p>Please fill in the following information to edit feedback details</p>
      </div>

      <form method="POST" action="{{ route('admin.feedback.update', ['feedback' => $feedback->feedbackID]) }}"
          id="editFeedbackForm">
          @csrf
          <div class="row">
            <div class="form-group col-md-6">
                <label for="clientName">Client Name</label>
                <input type="text" class="form-control" id="clientName" name="clientName" value="{{ $user->name }}" disabled>
            </div>
        </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="feedbackMessage">Feedback/Message <span class="form-required">*</span></label>
                  <textarea type="text" rows="4" class="form-control" id="feedbackMessage"
                      placeholder="Please edit your detailed feedback here."
                      name="feedbackMessage">{{ old('feedbackMessage', $feedback->feedbackMessage) }}</textarea>

                  @error('feedbackMessage')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group mb-0 col-md-6">
                  <label>Rating <span class="form-required">*</span></label>
                  <div class="rating w-50 m-0">
                      <input type="radio" name="rating" value="5" id="rating5"
                          {{ old('rating', $feedback->feedbackRating) == '5' ? 'checked' : '' }}><label class="m-0"
                          for="rating5">☆</label>
                      <input type="radio" name="rating" value="4" id="rating4"
                          {{ old('rating', $feedback->feedbackRating) == '4' ? 'checked' : '' }}><label class="m-0"
                          for="rating4">☆</label>
                      <input type="radio" name="rating" value="3" id="rating3"
                          {{ old('rating', $feedback->feedbackRating) == '3' ? 'checked' : '' }}><label class="m-0"
                          for="rating3">☆</label>
                      <input type="radio" name="rating" value="2" id="rating2"
                          {{ old('rating', $feedback->feedbackRating) == '2' ? 'checked' : '' }}><label class="m-0"
                          for="rating2">☆</label>
                      <input type="radio" name="rating" value="1" id="rating1"
                          {{ old('rating', $feedback->feedbackRating) == '1' ? 'checked' : '' }}><label for="rating1">☆</label>
                  </div>

                  @error('rating')
                  <div class="invalid-feedback mb-2">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6 mt-2">
                  <button type="submit" class="btn btn-primary btn-block">Update <i class="fa fa-arrow-right"
                          aria-hidden="true"></i></button>
              </div>
          </div>
      </form>
  </div>
</x-layout>
