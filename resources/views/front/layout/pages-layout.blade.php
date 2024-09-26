<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
<head>
       <meta charset="UTF-8" />
       <title>@yield('pageTitle')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta content="Monauto, Vente, Location, Achat" name="description" />
        <meta content="Monauto, Vente vehicule, Location vehicule, Achat vehicule" name="keywords" />
        <meta name="author" content="Sanga hamed bakayoko" />
        <meta name="website" content="https://monauto.ci" />
        <meta name="email" content="servicemarketing@monauto.ci" />
        <meta name="version" content="2.1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- favicon -->
            <link rel="icon" href="/images/site/{{ get_settings()->site_favicon }}" type="image/x-icon">

        <!-- Css -->
        <link href="{{ asset('front/assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
        <link href="{{ asset('front/assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet">
        <!-- Main Css -->
        <link href="{{ asset('front/assets/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('front/assets/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('front/assets/css/tailwind.min.css') }}" />

    

    @livewireStyles()
    @stack('stylesheets')
</head>


<body class="dark:bg-slate-900">
        <!-- Loader Start -->
        {{-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> --}}
<!-- Loader End -->

    <!-- Header Start -->
    @include('front.layout.inc.header')
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Start -->
    @include('front.layout.inc.footer')
    <!-- Footer Section End -->

  
<div class="fixed top-1/2 -left-2 z-3">
            <span class="relative inline-block rotate-90">
                <input type="checkbox" class="checkbox opacity-0 absolute" id="chk">
                <label class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-700 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8" for="chk">
                    <i class="uil uil-moon text-[20px] text-yellow-500 mt-1"></i>
                    <i class="uil uil-sun text-[20px] text-yellow-500 mt-1"></i>
                    <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] start-[2px] size-7"></span>
                </label>
            </span>
        </div>
     <!-- JAVASCRIPTS -->
        <script src="{{ asset('front/assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
        <script src="{{ asset('front/assets/libs/tobii/js/tobii.min.js') }}"></script>
        <script src="{{ asset('front/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/easy_background.js') }}"></script>
        <script src="{{ asset('front/assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/plugins.init.js') }}"></script>
        <script src="{{ asset('front/assets/js/app.js') }}"></script>
        <!-- JAVASCRIPTS -->

        <script>
            easy_background("#home",
                {
                    slide: ["{{ asset('front/assets/images/bg/01.png') }}"],
                    delay: [4000]
                }
            );
        </script>
    @livewireScripts()
    @stack('scripts')
</body>

</html>