@vite('resources/css/announcement.css')


<!-- Slider main container -->

<div class="announcement-container container-fluid pb-5">
<div class="h2 ml-5 pt-5 mb-5 text-light">News and Announcements</div>
<div class="swiper announcement-swiper col-9">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
      <!-- Slides -->
@foreach ($announcements as $announcement)
<div class="card swiper-slide border border-dark">
    <div class="card-img-top"><img src="{{ asset('storage/') }}/{{ $announcement->announcementPic }}"></div>
    <div class="card-body mt-3">
        <h5 class="card-title">{{ $announcement->announcementTitle }}</h5>
        <p class="card-text">{{ $announcement->announcementContent }}</p>
    </div>
</div>
@endforeach

  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar"></div>
</div>
</div>

<script>
  const announcement_swiper = new Swiper('.announcement-swiper', {
      // Optional parameters
      direction: 'horizontal',
      loop: true,
      slidesPerView: 1,
      // If we need pagination
      pagination: {
          el: '.swiper-pagination',
      },

      // Navigation arrows
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },

  });

</script>