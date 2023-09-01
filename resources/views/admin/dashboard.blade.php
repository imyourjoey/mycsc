<x-layout>
<x-navbar/>

<x-welcome-message />

<div class="card m-5" style="width:30%">
<div class="card-header">
    <h5 class="card-title">Inquiry</h5>
</div>
<div class="card-body d-flex flex-column align-items-center">
    <p class="card-text">Received Today: </p>
    <p><span class="badge badge-primary" style="font-size: 2rem; background-color:white; color:blue">{{ session('inquiryCount')}}</span></p>
  
</div>
</div>




</x-layout>