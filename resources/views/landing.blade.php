<x-layout>

<x-navbar />

<x-landing.hero />

<x-landing.who-are-we />

<x-landing.services-card />


<div class="container mt-4">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ul>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src= {{ asset('img/mycsc-hero.jpg')}} alt="Image 1">
        <div class="carousel-caption">
          <h3>Title 1</h3>
          <p>Description 1</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src= {{ asset('img/mycsc-hero.jpg')}} alt="Image 2">
        <div class="carousel-caption">
          <h3>Title 2</h3>
          <p>Description 2</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src= {{ asset('img/mycsc-hero.jpg')}} alt="Image 3">
        <div class="carousel-caption">
          <h3>Title 3</h3>
          <p>Description 3</p>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}



<x-landing.inquiry-form />

</x-layout>