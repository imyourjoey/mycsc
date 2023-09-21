<x-layout>
  <x-navbar />

  <div class="container">

      <div class="mt-4 mb-4">
        @if(session()->has('message'))
        <div class="row">
            <div class="form-group col-md-6">
                <a href="{{ route('announcement.index') }}">
                <button class=" d-block btn btn-primary mb-2 fade-in-button" >Back to Announcements</button>
                </a>   
            </div>
        </div>
      @endif
          <p class="h2">Edit Announcement</p>
          <p>Please update the information for the announcement.</p>
      </div>

      <form method="POST" action="{{ route('announcement.update', ['announcement' => $announcement->announcementID]) }}"
          id="editAnnouncementForm" enctype="multipart/form-data">
          @csrf
          @method('PUT') 

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="title">Title <span class="form-required">*</span></label>
                  <input type="text" class="form-control" id="title" placeholder="Enter the title of your announcement"
                      name="title" value="{{ old('title', $announcement->announcementTitle) }}">
                  @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
              <div class="form-group col-md-6">
                  <label for="description">Description <span class="form-required">*</span></label>
                  <textarea type="text" class="form-control" id="description"
                      placeholder="Provide a detailed description of your announcement"
                      name="description">{{ old('description', $announcement->announcementContent) }}</textarea>
                  @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              
                <label for="servicePic">Current Image</label>
                @if ($announcement->announcementPic)
                    <img class="mw-100 d-block border" src="{{ asset('storage/'.$announcement->announcementPic) }}" alt="Current Image">
                @else
                    <p>No picture available.</p>
                @endif
                <div class="custom-file mt-2">
                    <input type="file" class="custom-file-input" id="picture" name="picture">
                    <label class="custom-file-label" for="picture">No file chosen</label>
                    <small class="form-text text-muted">
                      Upload a new image if you wish to replace the current one.
                    </small>
                </div>

                @error('picture')
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
