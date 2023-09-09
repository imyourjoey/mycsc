@if(session()->has('message'))
    <script>
        toastr.success("{{session('message')}} ", {
            timeOut: 5000, 
            positionClass: "toast-top-right",
            

        });

    </script>
@elseif (session()->has('error'))
<script>
    toastr.error("{{ session('error') }}", {
        timeOut: 0, 
        positionClass: "toast-top-right",

    });

</script>
@endif

