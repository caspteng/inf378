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

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $message)
        $(document).ready(function () {
            $('body')
                .toast({
                    class: 'error',
                    message: `{{ $message }}`
                })
            ;
        });
        @endforeach
    </script>
@endif
