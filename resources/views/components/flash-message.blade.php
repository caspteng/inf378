@if (session()->has('flash.message'))
    <script>
        $(document).ready(function () {
            $('body')
                .toast({
                    displayTime: 5000,
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
                    title: 'Erreur',
                    displayTime: 11000,
                    showProgress: 'top',
                    class: 'error',
                    message: `{{ $message }}`
                })
            ;
        });
        @endforeach
    </script>
@endif
