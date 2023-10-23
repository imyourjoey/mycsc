

<x-layout>
  <style>
    .swiper {
        width: 90%;
        height: 700px;
        --swiper-pagination-color: #871719;
        --swiper-theme-color: #871719;
        --swiper-navigation-size: 25px;
    }


  
  </style>
<x-navbar/>
<x-welcome-message/>

<!-- Slider main container -->

<div class="container-fluid announcement-container p-0">
<div class="swiper announcement-swiper col-9">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
      <!-- Slides -->
@foreach ($announcements as $announcement)
<div class="card swiper-slide ">
    <div class="card-img-top" style="height: 500px; width: 100%; background-color: #f0f0f0;"><img style="height: 100%; width: 100%; object-fit: cover;" src="{{ asset('storage/') }}/{{ $announcement->announcementPic }}"></div>
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



</x-layout>
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