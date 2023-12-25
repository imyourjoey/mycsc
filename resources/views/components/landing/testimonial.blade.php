@vite('resources/css/testimonial.css')

<div class="container-fluid mt-5 testimonial-container">
  <div class="h2 ml-5 pt-5 text-light">Testimonials</div>
  <p class="text-light ml-5 p-0 mb-5">What Clients Say About Us?</p>
    <div class="row">
      <div class="swiper feedback-swiper col-12">
        <div class="swiper-wrapper" style="padding: 0">
        @foreach ($feedbacks as $feedback)
        <div class="col-4 swiper-slide">
            <div class="card" style="border-radius: 20px; min-height:20px;">
                <div class="card-body">
                    <blockquote class="blockquote mb-0" style="position: relative">
                        <i class="fa fa-quote-right"></i>
                        <p style="position: relative; z-index: 2; min-height:60px" class="mb-1">{{ $feedback->feedbackMessage }}</p>
                        <div class="feedback-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->feedbackRating)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        <footer class="blockquote-footer mt-1">{{ $feedback->name }}</footer>
                    </blockquote>
                </div>
            </div>
        </div>
        @endforeach
        </div>
        <div class="swiper-scrollbar"></div>
      </div>
    </div>

    <img src="{{ asset('img/testimonial.svg') }}" class="testimonial-image wow animate__animated animate__fadeInLeft animate__slow"  data-wow-offset="100">
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