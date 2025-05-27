<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    {{-- dir="{{ __('locale.dir') }}" --}}
<head >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

<div class="container-fluid position-relative d-flex p-0 flex-{{ app()->getLocale() == 'ar' ? 'row-reverse' : 'row' }}">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @extends('layouts.sidebar')

        <!-- Sidebar End -->


        <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                 <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                     <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                         <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                     </a>
                     <a href="#" class="sidebar-toggler flex-shrink-0">
                         <i class="fa fa-bars"></i>
                     </a>
                     {{-- <form class="d-none d-md-flex ms-4">
                         <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                     </form> --}}
                    <div class="navbar-nav align-items-center {{ app()->getLocale() == 'ar' ? 'me-auto' : 'ms-auto' }}">
                        <div class="nav-item dropdown">

                            <form action="{{ route('swap') }}" method="GET">
                                @csrf
                                <select name="locale" id="locale" class="form-control" onchange="this.form.submit()">
                                    @foreach ($available_locales as $index => $locale)
                                        <option value="{{ $locale }}" {{ $current_locale == $locale ? 'selected' : '' }}>
                                            {{ $index }}</option>
                                    @endforeach
                                </select>
                            </form>
                            {{-- <a href="{{route('swap', session()->get('locale') == 'en' ? 'ar' : 'en')}}" class="nav-link alert-success">{{session()->get('locale') == 'en' ? 'Arabic' : 'English'}}</a> --}}


                     </div>

                      {{-- notification --}}
                      <div class="nav-item dropdown dropdown-notifications">
                     @php $isArabic = app()->getLocale() == 'ar'; @endphp
                            <a href="#" class="nav-link dropdown-toggle d-flex {{ $isArabic ? 'flex-row-reverse text-end' : 'flex-row text-start' }}" data-bs-toggle="dropdown" style="align-items: center;">
                                <i data-count="0" class="fa fa-bell {{ $isArabic ? 'ms-lg-2' : 'me-lg-2' }}"></i>
                                <span class="d-none d-lg-inline-flex">
                                    {{ __('locale.notifications') }}
                                </span>
                            </a>

                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0 Notificatin-scroll">
                            <p  class="dropdown-title-text subtext mb-0 text-white op-6 ob-0 tx-12"></p>
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Welcome</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>

                         <div class="nav-item dropdown">
                             <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                 {{-- <img class="rounded-circle me-lg-2" src="{{ asset('storage/' .$user_data->userable->image) }}" alt="" style="width: 40px; height: 40px;"> --}}
                                 <span class="d-none d-lg-inline-flex">{{$user_data->name }}</span>
                             </a>
                             <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                 <a href="{{ route('profile.index') }}" class="dropdown-item">My Profile</a>
                                 {{-- <a href="#" class="dropdown-item">Settings</a> --}}
                                 <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>

                             </div>
                         </div>
                     </div>
                 </nav>
                 <!-- Navbar End -->



     @yield('content' )













            <!-- Footer Start -->
            @extends('layouts.footer')

            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    {{-- <script>
    $(document).ready(function () {
        var notificationsWrapper = $('.dropdown-notifications');
        var notificationsCountElem = notificationsWrapper.find('i[data-count]');
        var notificationsList = $('.Notificatin-scroll');
        // notificationsCountElem.show();
        Pusher.logToConsole = true;

        const pusher = new Pusher('b059361fe37c6e8f86dd', {
            cluster: 'mt1',
            encrypted: true
        });

        const channel = pusher.subscribe('my-channel');
        channel.bind('App\\Events\\MyEvent', function (data) {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();

    var timeString = hours + ':' + minutes;
            var newNotificationHtml = `
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">${data.message}</h6>
                    <small>${timeString}</small>
                </a>
                <hr class="dropdown-divider">
            `;


            notificationsList.prepend(newNotificationHtml);


            var notificationsCount = parseInt(notificationsCountElem.data('count'));
            notificationsCount += 1;
            notificationsCountElem.data('count', notificationsCount);
            notificationsCountElem.text(notificationsCount);
        });
    });
    </script> --}}

    @yield('script')
</body>

</html>
