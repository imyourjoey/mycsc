<x-layout>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.js" integrity="sha512-QokzG/B/9i5X3BYbmuyNn2ah9EiApK5KY4saOYZRCQINuB+X52ED0L3RCc/1x7YUA85qaFZ9uoB4x5SmkLGCJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.css" integrity="sha512-dGydSZpRi9eEJoxwfHfT6BF7tNoma1GQbCIonlVR4IRfdcnjvJW6dcfS2uGlRdqPRryPzesROUSjR7VDKG4TeA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <x-navbar />

    <x-landing.hero />

    <x-landing.who-are-we />

    <x-landing.services-card :services="$services"/>

    <x-landing.announcement />

    <x-landing.training/>


    <div class="container-fluid">
      <div class="row">
        <div class="col-5">
        <div class="card" style="border-radius: 20px">

          <div class="card-body">
            <blockquote class="blockquote mb-0" style="position: relative">
              <i class="fa fa-quote-right" style="position: absolute; top:0; right:20px; font-size: 50px; color:#d4d4d4; z-index:1"></i>
              <p style="position:relative;z-index:2" class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante dsadsdsa.</p>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              
              <footer class="blockquote-footer mt-1">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
          </div>
        </div>
        
        </div>
      </div>
    </div>

    <x-landing.inquiry-form />

</x-layout>
