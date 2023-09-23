<style>
  .swiper {
      width: 90%;
      height: 700px;
      --swiper-pagination-color: #871719;
      --swiper-theme-color: #871719;
      --swiper-navigation-size: 25px;
  }

</style>


<!-- Slider main container -->

<div class="container-fluid pb-5" style="background: black">
<div class="h2 ml-5 pt-5 mb-5 text-light">News and Announcements</div>
<div class="swiper announcement-swiper col-9">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
      <!-- Slides -->
      <div class="card swiper-slide border border-dark">
          <div class="card-img-top" style="height: 500px; width: 100%; background-color: #f0f0f0;"><img style="height: 100%; width: 100%; object-fit: cover;" src="{{ asset('storage/'.'announcements/RqhPIuK60FKi2wcJLVa9BW2u91xElqDCFnCa5ToM.jpg') }}" alt=""></div>
          <div class="card-body mt-3">
              <h5 class="card-title">Person 1</h5>
              <p class="card-text">Description of Person 1.</p>
          </div>
      </div>
      <div class="card swiper-slide">
          <div class="card-img-top" style="height: 300px; width: 100%; background-color: #f0f0f0;"></div>
          <div class="card-body mt-3">
              <h5 class="card-title">Person 2</h5>
              <p class="card-text">Description of Person 1.</p>
          </div>
      </div>
      <div class="card swiper-slide">
          <div class="card-img-top" style="height: 300px; width: 100%; background-color: #f0f0f0;"></div>
          <div class="card-body mt-3">
              <h5 class="card-title">Person 3</h5>
              <p class="card-text">Description of Person 1.</p>
          </div>
      </div>

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