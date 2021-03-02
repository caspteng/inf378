@if (session()->has('flash.message'))
    <script>
        $(document).ready(function () {
            $('body')
                .toast({
                    class: '{{ session('flash.class') }}',
                    message: `{{ session('flash.message') }}`
                })
            ;
        });
    </script>
@endif
