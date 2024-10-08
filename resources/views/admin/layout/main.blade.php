<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ Asset('favicon.ico') }}" />
    <link rel="icon" href="{{ Asset('favicon.ico') }}" type="image/ico" sizes="16x16">
    <link rel="stylesheet" href="{{ Asset('assets/vendor/pace/pace.css') }}">
    <script src="{{ Asset('assets/vendor/pace/pace.min.js') }}"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ Asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Asset('assets/vendor/jquery-scrollbar/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ Asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ Asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ Asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ Asset('assets/vendor/timepicker/bootstrap-timepicker.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ Asset('assets/fonts/jost/jost.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ Asset('assets/fonts/materialdesignicons/materialdesignicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Asset('assets/css/atmos.css?v=') }}<?php echo time(); ?>">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    @yield('css')


</head>

<body class="sidebar-pinned ">
    <aside class="admin-sidebar">
        @include('admin.layout.menu')
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            @include('admin.layout.header')
        </header>
        <section class="admin-content">
            <div class="bg-dark m-b-30">
                <div class="container">
                    <div class="row p-b-60 p-t-60">
                        <div class="col-md-10 mx-auto text-center text-white p-b-30">

                            @if (Request::segment(3))
                                <h1
                                    style="text-align: left;text-transform: uppercase;font-size: 22px;font-weight: 900">
                                    @yield('title')</h1>
                            @else
                                <h1
                                    style="text-align: left;margin-left: -8%;text-transform: uppercase;font-size: 22px;font-weight: 900">
                                    @yield('title')</h1>
                            @endif

                            @if (Session::has('error'))
                                <div class="row" style="text-align: left">
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-8" style="margin-left: 2%;margin-top: 2%">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>ERROR : </strong> {{ Session::get('error') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (Session::has('message'))
                                <div class="row" style="text-align: left">
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-8" style="margin-left: 2%;margin-top: 2%">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>SUCCESS : </strong> {{ Session::get('message') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())

                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="color:white">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            </div>
            </div>
            </div>
        </section>
    </main>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/popper/popper.js') }}"></script>
    <script src="{{ Asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/listjs/listjs.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ Asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ Asset('assets/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ Asset('assets/js/atmos.min.js') }}"></script>
    <!--page specific scripts for demo-->


    <!--Additional Page includes-->
    <!--chart data for current dashboard-->
    <script src="{{ Asset('assets/js/dashboard-05.js') }}"></script>
    <script src="{{ Asset('assets/vendor/sweetalert/sweetalert2.all.min.js') }}"></script>

    <script>
        function deleteConfirm(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'This Entry has been deleted.',
                        'success'
                    )

                    window.location = url;
                }
            })
        }

        function confirmAlert(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Changed!',
                        'This Entry has been Changed.',
                        'success'
                    )

                    window.location = url;
                }
            })
        }

        function showMsg(data) {
            Swal.fire(data);
        }
    </script>

    @yield('js')

</body>

</html>
