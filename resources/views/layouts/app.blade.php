<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- head -->
    @include('partials._head')

</head>
<body>

    <div id="app">
        <!-- navigation -->
        @include('partials._navigation')

        <main class="py-4">

            <div class="container">

                <!-- content section -->
                @yield('content')

            </div>

            
        </main>
    </div>
    
    @include('partials._scripts')
    
</body>
</html>
