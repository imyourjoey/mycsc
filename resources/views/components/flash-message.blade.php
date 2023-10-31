@if(session()->has('message'))
    <script>
        toastr.success("{{session('message')}}");

    </script>
@elseif (session()->has('error'))
<script>
    toastr.options.positionClass = 'toast-top-right';
    toastr.error("{{ session('error') }}");
</script>

@endif

