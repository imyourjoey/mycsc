@if(session()->has('message'))
    <div x-data="{show:true}" x-init="setTimeout(()=>show = false, 4000)" x-show="show" 
        class="flash-message">
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif

@if(session()->has('warning'))
    <div x-data="{show:true}" x-init="setTimeout(()=>show = false, 4000)" x-show="show" 
        class="flash-message" style="background: red">
        <p>
            {{ session('warning') }}
        </p>
    </div>
@endif
