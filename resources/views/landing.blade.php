<x-layout>
  

  



    <x-navbar />

    <x-landing.hero />

    <x-landing.who-are-we />

    <div id="service-section" data-offset="80">
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



  
