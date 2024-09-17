<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session()->has('dir') ? session()->get('dir') : 'ltr' , }}"> --}}
<html lang="en" onload="pageLoad()">
<head>
    @yield('before_head')
    @include('landing-page.partials._head') 
      @include('landing-page.partials._currencyscripts') 

    @yield('after_head')

    <style>

        .custome-seatei {
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .custome-seatei.active {
            display: block;
            overflow: visible;
            text-overflow: clip;
            -webkit-line-clamp: initial;
        }
            .category-section {
                padding-bottom: 0rem !important;
            }
    
            [data-bs-theme="dark"] {
                .logo-normal {
                    .darkmode-logo {
                        display: none;
                    }
    
                    .light-logo {
                        display: block;
                    }
                }
            }
    
            [data-bs-theme="light"] {
                .logo-normal {
                    .darkmode-logo {
                        display: block;
                    }
    
                    .light-logo {
                        display: none;
                    }
                }
            }
    
    
            .static-banner-element {
                background-position: 50%;
                background-size: cover;
                /* filter: blur(5px); */
                height: 700px;
                width: 100%;
            }
    
    
    
            .btn-outline-primary {
                --bs-btn-color: #ffffff;
                --bs-btn-border-color: #ffffff;
                --bs-btn-hover-color: #fff;
                --bs-btn-hover-bg: #e21ab5;
                --bs-btn-hover-border-color: #e21ab5;
                --bs-btn-focus-shadow-rgb: 42, 74, 64;
                --bs-btn-active-color: #fff;
                --bs-btn-active-bg: #e21ab5;
                --bs-btn-active-border-color: #e21ab5;
                --bs-btn-active-shadow: 0 0px 0px rgba(0, 0, 0, 0);
                --bs-btn-disabled-color: #e21ab5;
                --bs-btn-disabled-bg: transparent;
                --bs-btn-disabled-border-color: #e21ab5;
                --bs-gradient: none;
            }
    
            .dark .btn-outline-primary {
                --bs-btn-color: #e21ab5;
                --bs-btn-border-color: #e21ab5;
                --bs-btn-hover-color: #fff;
                --bs-btn-hover-bg: #e21ab5;
                --bs-btn-hover-border-color: #e21ab5;
                --bs-btn-focus-shadow-rgb: 42, 74, 64;
                --bs-btn-active-color: #fff;
                --bs-btn-active-bg: #e21ab5;
                --bs-btn-active-border-color: #e21ab5;
                --bs-btn-active-shadow: 0 0px 0px rgba(0, 0, 0, 0);
                --bs-btn-disabled-color: #e21ab5;
                --bs-btn-disabled-bg: transparent;
                --bs-btn-disabled-border-color: #e21ab5;
                --bs-gradient: none;
            }
    
            .btn-link {
                --bs-btn-font-weight: 400;
                --bs-btn-color: white;
                --bs-btn-bg: transparent;
                --bs-btn-border-color: transparent;
                --bs-btn-hover-color: rgba(var(--bs-primary-rgb), 0.85);
                --bs-btn-hover-border-color: transparent;
                --bs-btn-active-color: rgba(var(--bs-primary-rgb), 0.85);
                --bs-btn-active-border-color: transparent;
                --bs-btn-disabled-color: #6c757d;
                --bs-btn-disabled-border-color: transparent;
                --bs-btn-box-shadow: 0 0 0 #000;
                --bs-btn-focus-shadow-rgb: 74, 101, 93;
                text-decoration: none;
            }
    
            .dark .btn-link {
                --bs-btn-font-weight: 400;
                --bs-btn-color: var(--bs-primary);
                --bs-btn-bg: transparent;
                --bs-btn-border-color: transparent;
                --bs-btn-hover-color: rgba(var(--bs-primary-rgb), 0.85);
                --bs-btn-hover-border-color: transparent;
                --bs-btn-active-color: rgba(var(--bs-primary-rgb), 0.85);
                --bs-btn-active-border-color: transparent;
                --bs-btn-disabled-color: #6c757d;
                --bs-btn-disabled-border-color: transparent;
                --bs-btn-box-shadow: 0 0 0 #000;
                --bs-btn-focus-shadow-rgb: 74, 101, 93;
                text-decoration: none;
            }
    
            .dark .text-primary {
                --bs-text-opacity: 1;
                color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity)) !important;
            }
    
            .text-primary {
                color: white !important;
            }
    
            .select2-container .select2-selection--single .select2-selection__rendered {
                padding-left: 0 !important;
                color: white !important;
            }
    
            .dark .select2-container .select2-selection--single .select2-selection__rendered {
                padding-left: 0 !important;
                color: #6c757d !important;
            }
    
            .pagination {
                --bs-pagination-padding-x: 1rem;
                --bs-pagination-padding-y: 0.25rem;
                --bs-pagination-font-size: 1rem;
                --bs-pagination-color: white !important;
                --bs-pagination-border-width: var(--bs-border-width);
                --bs-pagination-border-color: var(--bs-border-color);
                --bs-pagination-border-radius: var(--bs-border-radius);
                --bs-pagination-hover-color: var(--bs-primary);
                --bs-pagination-hover-bg: var(--bs-gray-200);
                --bs-pagination-hover-border-color: var(--bs-gray-300);
                --bs-pagination-focus-color: var(--bs-primary);
                --bs-pagination-focus-bg: var(--bs-gray-200);
                --bs-pagination-focus-box-shadow: 0 0rem 0rem 0rem rgba(42, 74, 64, 0.15);
                --bs-pagination-active-color: var(--bs-white);
                --bs-pagination-active-bg: var(--bs-primary);
                --bs-pagination-active-border-color: var(--bs-primary);
                --bs-pagination-disabled-color: var(--bs-gray-500);
                --bs-pagination-disabled-bg: var(--bs-light);
                --bs-pagination-disabled-border-color: var(--bs-border-color);
                display: flex;
                padding-left: 0;
                list-style: none;
            }
    
            .dark .pagination {
                --bs-pagination-padding-x: 1rem;
                --bs-pagination-padding-y: 0.25rem;
                --bs-pagination-font-size: 1rem;
                --bs-pagination-color: #e21ab5 !important;
                --bs-pagination-border-width: var(--bs-border-width);
                --bs-pagination-border-color: var(--bs-border-color);
                --bs-pagination-border-radius: var(--bs-border-radius);
                --bs-pagination-hover-color: var(--bs-primary);
                --bs-pagination-hover-bg: var(--bs-gray-200);
                --bs-pagination-hover-border-color: var(--bs-gray-300);
                --bs-pagination-focus-color: var(--bs-primary);
                --bs-pagination-focus-bg: var(--bs-gray-200);
                --bs-pagination-focus-box-shadow: 0 0rem 0rem 0rem rgba(42, 74, 64, 0.15);
                --bs-pagination-active-color: var(--bs-white);
                --bs-pagination-active-bg: var(--bs-primary);
                --bs-pagination-active-border-color: var(--bs-primary);
                --bs-pagination-disabled-color: var(--bs-gray-500);
                --bs-pagination-disabled-bg: var(--bs-light);
                --bs-pagination-disabled-border-color: var(--bs-border-color);
                display: flex;
                padding-left: 0;
                list-style: none;
            }
    
            .form-select {
                --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
                display: block;
                width: 100%;
                padding: 0.8rem 3rem 0.8rem 1rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.75;
                color: white !important;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                background-color: var(--bs-gray-300);
                background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
                background-repeat: no-repeat;
                background-position: right 1rem center;
                background-size: 16px 12px;
                border: var(--bs-border-width) solid transparent;
                border-radius: var(--bs-border-radius-lg);
                box-shadow: var(--bs-box-shadow-inset);
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }
    
            .dark .form-select {
                --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
                display: block;
                width: 100%;
                padding: 0.8rem 3rem 0.8rem 1rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.75;
                color: rgb(3, 3, 3) !important;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                background-color: var(--bs-gray-300);
                background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
                background-repeat: no-repeat;
                background-position: right 1rem center;
                background-size: 16px 12px;
                border: var(--bs-border-width) solid transparent;
                border-radius: var(--bs-border-radius-lg);
                box-shadow: var(--bs-box-shadow-inset);
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }
        </style>
</head>
<script>
    var frontendLocale = "{{ session()->get('locale') ?? 'fr' }}";
    sessionStorage.setItem("local", frontendLocale);
    (function() {
        const savedTheme = localStorage.getItem('data-bs-theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        if (savedTheme === 'dark') {
            document.body.classList.add('dark');
        }
    })();
</script>
<body class="body-bg">


    <span class="screen-darken"></span>

    <div id="loading">
        @include('landing-page.partials.loading')
    </div>


    <main class="main-content" id="landing-app">
        <div class="position-relative">

            @include('landing-page.partials._header')
        </div>
        @yield('content')
    </main>

    @include('landing-page.partials._footer')

    @include('landing-page.partials.cookie')

    @include('landing-page.partials.back-to-top')



  @yield('before_script')
    @include('landing-page.partials._scripts')
    @yield('after_script')
    
  

    <script>
        function pageLoad() {
            var html = localStorage.getItem('data-bs-theme');
            if (html == null) {
                html = 'light';
            }
            if (html == 'light') {
                jQuery('body').addClass('dark');
                $('.darkmode-logo').removeClass('d-none')
                $('.light-logo').addClass('d-none')
            } else {
                jQuery('body').removeClass('dark');
                $('.darkmode-logo').addClass('d-none')
                $('.light-logo').removeClass('d-none')
            }
        }
        pageLoad();

        const savedTheme = localStorage.getItem('data-bs-theme');
        if (savedTheme === 'dark') {
            $('html').attr('data-bs-theme', 'dark');
        } else {
            $('html').attr('data-bs-theme', 'light');
        }

        $('.change-mode').on('click', function() {
            const body = jQuery('body')
            var html = $('html').attr('data-bs-theme');
            console.log('mode ' +html);

            if (html == 'light') {
                body.removeClass('dark');
                $('html').attr('data-bs-theme', 'dark');
                $('.darkmode-logo').addClass('d-none')
                $('.light-logo').removeClass('d-none')
                localStorage.setItem('dark', true)
                localStorage.setItem('data-bs-theme', 'dark')
            } else {

                $('.body-bg').addClass('dark');
                $('html').attr('data-bs-theme', 'light');
                $('.darkmode-logo').removeClass('d-none')
                $('.light-logo').addClass('d-none')
                localStorage.setItem('dark', false)
                localStorage.setItem('data-bs-theme', 'light')
            }

        })

    </script>

    <script>
        $(document).ready(function() {
            $('.textbuttoni').click(function() {
                $(this).prev('.custome-seatei').toggleClass('active');
                if ($(this).text() === '{{ __('landingpage.read_more') }}') {
                    $(this).text('{{ __('landingpage.read_less') }}');
                } else {
                    $(this).text('{{ __('landingpage.read_more') }}');
                }
            });
        });
    </script>
   
</body>
</html>
