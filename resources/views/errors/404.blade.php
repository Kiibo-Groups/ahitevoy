<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>404 Page Not Found | Por favor compruebe la ruta que desea acceder</title>
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
    <link rel="stylesheet" type="text/css" href="{{ Asset('assets/fonts/materialdesignicons/materialdesignicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Asset('assets/css/atmos.css?v=') }}<?php echo time(); ?>">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>


<body data-spy="scroll" data-target=".navbar" data-offset="90">

    <div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="text-center">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('assets/img/404.svg') }}" alt=""  class="logo-light mx-auto">
                    </a>
                </div>
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center">
                            <h1 class="text-error">404 NOT FOUND!</h1>
                            <h3 class="mt-3 mb-2">Página no encontrada</h3>
                            <p class="text-muted mb-3">
                                Parece que has tomado un camino equivocado. No te preocupes... <b>sucede!!</b>
                                <br />
                                He aquí unos pequeños consejo que podrían ayudarle a volver a la normalidad.
                                
                                <ul style="list-style: none;text-align:left">
                                    <li>
                                       1.- comprobar tu conexión a Internet.
                                    </li>
                                    <li>
                                        2.- Validar la ruta que estas intentando ingresar.
                                    </li>
                                    <li>
                                        3.- Validar tus credenciales de acceso.
                                    </li>
                                </ul>

                                
                                </p>

                            <a href="javascript:void(0)" onclick="history.back()" class="btn btn-danger waves-effect waves-light"><i class="fas fa-home mr-1"></i> Back to Home</a>
                        </div>


                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>

    
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
 
</body>

</html>
