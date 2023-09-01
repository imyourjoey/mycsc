<div class="card welcome-card">
  <div class="card-header">
      <h3> {{ date('d/m/Y') }}</h3>
  </div>
  <div class="card-body">
      @php
          $hour = date('G');
          if ($hour >= 5 && $hour < 12) {
              $greeting = 'Good morning';
          } elseif ($hour >= 12 && $hour < 18) {
              $greeting = 'Good afternoon';
          } else {
              $greeting = 'Good evening';
          }
      @endphp

      <h4>{{ $greeting }}, {{ auth()->user()->name }}</h4>

      
  </div>
</div>