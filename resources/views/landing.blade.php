<x-layout>

    {{-- wow.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


  



    <x-navbar />

    <x-landing.hero />

    <x-landing.who-are-we />

    <x-landing.appointment/>

    <div id="service-section" data-offset="40">
    <x-landing.services-card :services="$services"/>
    </div>

    <div id="news-section" data-offset="0">
    <x-landing.announcement :announcements="$announcements"/>
    </div>

    <div id="training-section" data-offset="0">
    <x-landing.training :trainings="$trainings"/>
    </div>

    <div id="testimonial-section" data-offset="0">
    <x-landing.testimonial :feedbacks="$feedbacks"/>
    </div>

    <div id="inquiry-section" data-offset="0">
    <x-landing.inquiry-form />
    </div>

</x-layout>


{{-- smoothscroll --}}
<script src="https://cdn.jsdelivr.net/gh/LieutenantPeacock/SmoothScroll@1.2.0/src/smoothscroll.min.js" integrity="sha384-UdJHYJK9eDBy7vML0TvJGlCpvrJhCuOPGTc7tHbA+jHEgCgjWpPbmMvmd/2bzdXU" crossorigin="anonymous"></script>

  <script>
    document.querySelectorAll('.smooth-scroll').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const sectionId = this.getAttribute('data-section');
            const targetSection = document.getElementById(sectionId);

            if (targetSection) {
                const offset = parseInt(targetSection.getAttribute('data-offset')) || 0;
                const targetPosition = targetSection.getBoundingClientRect().top + window.scrollY - offset;

                smoothScroll({
                    yPos: targetPosition,
                    duration: 500, // Adjust the duration if needed
                     // Set the easing function to linear for no easing
                });
            }
        });
    });
</script>


{{-- wow.js --}}
<script>
    new WOW().init();
</script>



  
