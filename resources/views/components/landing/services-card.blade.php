@vite('resources/css/services.css')


<div class="container-fluid mb-5">
  <h2 class="ml-5 mt-4 mb-3">Services</h2>
        <div class="row justify-content-between pr-5 pl-5" >
            <div class="swiper service-swiper col-12" style="height: 450px">
                <div class="swiper-wrapper">
            @foreach ($services as $service)
            <div class="col-md-4 mt-1 swiper-slide">
                <div class="card p-3">
                    <div class="card-img-top" style="height: 220px; background-image: url('{{ asset('storage/') }}/{{ $service->servicePic }}'); background-position: center; background-size: contain; background-repeat: no-repeat;" ></div>
                    <div class="card-body p-0 mt-3">
                        <h5 class="card-title">{{ $service->serviceName }}</h5>
                        <p class="card-text">{{ $service->serviceDesc }}</p>
                        {{-- <a href="#" class="btn btn-primary form-control">Learn More</a> --}}
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
        const service_swiper = new Swiper('.service-swiper', {
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
