@if(session()->has('message'))
    <script>
        toastr.success("{{session('message')}}");
    </script>
@elseif (session()->has('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>

@endif

