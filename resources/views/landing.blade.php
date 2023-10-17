<x-layout>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.min.js" integrity="sha512-QokzG/B/9i5X3BYbmuyNn2ah9EiApK5KY4saOYZRCQINuB+X52ED0L3RCc/1x7YUA85qaFZ9uoB4x5SmkLGCJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.0/swiper-bundle.css" integrity="sha512-dGydSZpRi9eEJoxwfHfT6BF7tNoma1GQbCIonlVR4IRfdcnjvJW6dcfS2uGlRdqPRryPzesROUSjR7VDKG4TeA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <x-navbar />

    <x-landing.hero />

    <x-landing.who-are-we />

    <x-landing.services-card :services="$services"/>

    <x-landing.announcement :announcements="$announcements"/>

    <x-landing.training :trainings="$trainings"/>

    <x-landing.testimonial :feedbacks="$feedbacks"/>

    <x-landing.inquiry-form />

</x-layout>
