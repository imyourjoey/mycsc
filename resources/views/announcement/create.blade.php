
<x-layout>
  <x-navbar />


  <div class="container">

      <div class="mt-4 mb-4">
          <p class="h2">Create New Announcement</p>
          <p>Please fill in the following information to create a new announcement.</p>
      </div>

      <form method="POST" action={{ route('announcement.store') }} id="createAnnouncementForm" enctype="multipart/form-data">
      @csrf
          <div class="row">
              <div class="form-group col-md-6">
                  <label for="title">Title <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="title"
                      placeholder="Enter the title of your announcement" name="title" value="{{ old('title') }}">

                      @error('title')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="description">Description <span class="form-required">*</span></label>
                  <textarea type="text" class="form-control" id="description"
                      placeholder="Provide a detailed description of your announcement" name="description" value="{{ old('description') }}"></textarea>

                      @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
              </div>

          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="picture">Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="picture" name="picture">
                    <label class="custom-file-label" for="picture">Choose an image for the announcement (optional)</label>
                  </div>

                      @error('picture')
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

