


<div class="container-fluid mt-5" style="background: black">
  <div class="h2 ml-5 pt-5 text-light ">Testimonials</div>
  <p class="text-light ml-5 p-0 mb-5">What Clients Say About Us?</p>
    <div class="row">
      <div class="swiper feedback-swiper col-12" style="height: 300px">
        <div class="swiper-wrapper">
        @foreach ($feedbacks as $feedback)
        <div class="col-5 swiper-slide">
            <div class="card" style="border-radius: 20px">
                <div class="card-body">
                    <blockquote class="blockquote mb-0" style="position: relative">
                        <i class="fa fa-quote-right" style="position: absolute; top: 0; right: 20px; font-size: 50px; color: #d4d4d4; z-index: 1;"></i>
                        <p style="position: relative; z-index: 2;" class="mb-1">{{ $feedback->feedbackMessage }}</p>
                        <div class="feedback-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->feedbackRating)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        <footer class="blockquote-footer mt-1">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
        @endforeach
        </div>
        <div class="swiper-scrollbar"></div>
      </div>
    </div>
</div>

<script>
    const feedback_swiper = new Swiper('.feedback-swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 3,
        centeredSlides: true,
        scrollbar: {
        el: ".swiper-scrollbar",
        hide: "true",
        },
        
    });
    </script>