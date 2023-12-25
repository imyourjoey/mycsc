@vite('resources/css/hero.css')

{{-- hero section --}}
<div class="hero">
  <img class="hero-image" src= {{ asset('img/mycsc-hero.jpg')}} alt="Hero Image">
  <div class="hero-text">
    <div class="h1" style="font-size: 35px">
      <span class="animate__animated animate__fadeIn">Your</span>  

      <span class="animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 65px; display:inline-block" >Privacy</span> 

      <span class="animate__animated animate__fadeIn">is Our </span>

      <span style="font-size: 65px; display:inline-block" class="animate__animated animate__fadeInUp animate__delay-2s">Priority</span>
    </div>
  </div>
</div>