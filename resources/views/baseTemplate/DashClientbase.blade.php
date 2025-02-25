<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>COWORKING</title>
  <!-- loader-->
  <link href="fronts/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="fronts/assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="fronts/assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="fronts/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="fronts/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="fronts/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="fronts/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="fronts/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="fronts/assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="fronts/assets/css/app-style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="fronts/assets/css/espaceTravail.css">
    {{-- front tables --}}
    <link rel="stylesheet" href="fronts/assets/css/reservation.css"> <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="fronts/assets/css/myResa.css"> <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="fronts/assets/css/paiement.css"> <!-- Lien vers le fichier CSS -->

    {{-- DASHBOARD --}}

    <link rel="stylesheet" href="fronts2/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="fronts2/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="fronts2/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <link rel="stylesheet" href="fronts2/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="fronts2/assets/images/favicon.png" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Import de Chart.js -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fronts/assets/css/chart.css">
    <link rel="stylesheet" href="fronts/assets/css/csvImport.css">
    <!-- Lien vers la police Inter (optionnel) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fronts/assets/css/optionPayante.css">
    <!-- Lien vers la police Inter (optionnel) -->
    <!-- Lien vers FontAwesome pour les icônes (optionnel) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fronts/assets/css/payeeNonPayee.css">
    <!-- Lien vers FontAwesome pour les icônes (optionnel) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fronts/assets/css/validationPaiement.css">
    <link rel="stylesheet" href="fronts/assets/css/creneaux.css">


</head>

<body class="bg-theme bg-theme1">

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="fronts/assets/images/coworking.png" class="logo-icon" alt="logo icon" width="100" height=auto>
       <h5 class="logo-text">coworking</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      @yield('navigation')
    </ul>

   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
        <form action="@yield('actionForm')" method="POST" class="search-bar">
            @csrf
            @yield('rechercheInput')
        </form>
  <h6 class="mt-2 user-title">@yield('nomHeader')</h6>
</nav>
</header>
  <div class="content-wrapper">

  <!--Start Dashboard Content-->

        @yield('contentDaschClient')



    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2025 GESTION COWORKING
        </div>
      </div>
    </footer>
	<!--End footer-->

  <!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>

      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>

      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>

     </div>
   </div>
  <!--end color switcher-->

  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="fronts/assets/js/jquery.min.js"></script>
  <script src="fronts/assets/js/popper.min.js"></script>
  <script src="fronts/assets/js/bootstrap.min.js"></script>

 <!-- simplebar js -->
  <script src="fronts/assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="fronts/assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <script src="fronts/assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="fronts/assets/js/app-script.js"></script>
  <!-- Chart js -->

  <script src="fronts/assets/plugins/Chart.js/Chart.min.js"></script>

  <!-- Index js -->
  <script src="fronts/assets/js/index.js"></script>


  <script src="fronts2/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="fronts2/assets/vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="fronts2/assets/js/off-canvas.js"></script>
  <script src="fronts2/assets/js/hoverable-collapse.js"></script>
  <script src="fronts2/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="fronts2/assets/js/chart.js"></script>

</body>
</html>
