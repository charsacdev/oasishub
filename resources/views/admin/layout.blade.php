<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icon.png')}}">
  <title>Admin Dashboard - Oasis Hub</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.css" rel="stylesheet">
  <link href="{{asset('assets/css/admin.css')}}" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
  <div class="row" style="overflow: hidden">
    <!-- Sidebar (visible on desktop) -->
    <nav class="col-md-3 col-lg-2 d-none d-md-block sidebar p-3" style="
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            width: 240px;
            z-index: 1000;
        ">>
      <h4 class="text-white mb-4">
        <img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="">
      </h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fa-solid fa-chart-line me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('admin.properties') }}" class="nav-link"><i class="fa-solid fa-building me-2"></i> Assets</a></li>
         <li class="nav-item"><a href="{{ route('admin.manageproperties') }}" class="nav-link text-white"><i class="fa-solid fa-building me-2"></i>Manage Assets</a></li>
        <li class="nav-item"><a href="{{ route('admin.orders') }}" class="nav-link"><i class="fa-solid fa-receipt me-2"></i> Orders</a></li>
        <li class="nav-item"><a href="{{ route('admin.preorderpage') }}" class="nav-link"><i class="fa-solid fa-receipt me-2"></i>Pre Orders</a></li>
        <li class="nav-item"><a href="{{ route('admin.messages') }}" class="nav-link"><i class="fa-solid fa-envelope me-2"></i> Messages</a></li>
        <li class="nav-item"><a href="{{ route('admin.category') }}" class="nav-link text-white"><i class="fa-solid fa-gear me-2"></i> Category</a></li>
        <li class="nav-item"><a href="{{ route('admin.settings') }}" class="nav-link"><i class="fa-solid fa-gear me-2"></i> Settings</a></li>
         <li class="nav-item"><a href="{{ route('admin.logout') }}" class="nav-link text-white"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a></li>
      </ul>
    </nav>

    <!-- Offcanvas (mobile menu) -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="" style="width:150px">
        </a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <div class="offcanvas offcanvas-start bg-dark text-white d-md-none" tabindex="-1" id="offcanvasMenu">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white"><i class="fa-solid fa-chart-line me-2"></i> Dashboard</a></li>
          <li class="nav-item"><a href="{{ route('admin.properties') }}" class="nav-link text-white"><i class="fa-solid fa-building me-2"></i> Asset</a></li>
           <li class="nav-item"><a href="{{ route('admin.manageproperties') }}" class="nav-link text-white"><i class="fa-solid fa-building me-2"></i>Manage Asset</a></li>
          <li class="nav-item"><a href="{{ route('admin.orders') }}" class="nav-link text-white"><i class="fa-solid fa-receipt me-2"></i> Orders</a></li>
          <li class="nav-item"><a href="{{ route('admin.preorderpage') }}" class="nav-link"><i class="fa-solid fa-receipt me-2"></i>Pre Orders</a></li>
          <li class="nav-item"><a href="{{ route('admin.messages') }}" class="nav-link text-white"><i class="fa-solid fa-envelope me-2"></i> Messages</a></li>
          <li class="nav-item"><a href="{{ route('admin.category') }}" class="nav-link text-white"><i class="fa-solid fa-gear me-2"></i> Category</a></li>
          <li class="nav-item"><a href="{{ route('admin.settings') }}" class="nav-link text-white"><i class="fa-solid fa-gear me-2"></i> Settings</a></li>
          <li class="nav-item"><a href="{{ route('admin.logout') }}" class="nav-link text-white"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
        </ul>
      </div>
    </div>

    <style>
          .main-content {
            margin-left: 240px; /* match sidebar width */
            padding: 1rem;
            min-height: 100vh;
          }

          @media (max-width: 768px) {
            .sidebar {
              display: none;
            }
            .main-content {
              margin-left: 0;
            }

          }
    </style>
    
     <div class="main-content">
      @yield('content')
    </div>

   </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script>
  $(document).ready(function() {

    $('#bookingsTable').DataTable({
        responsive: true
    });

    $('#propertiesTable').DataTable({
        responsive: true
    });

    $("#ordersTable").DataTable({
        "pageLength": 20,
        "lengthChange": false,
        "ordering": true,
        "autoWidth": false
    })

     $('.summernote').summernote({
        placeholder: 'Enter property description...',
        height: 200,
        tabsize: 2
      });

      $('#summernote2').summernote({
        placeholder: 'Type your message here...',
        tabsize: 2,
        height: 250,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['fontsize', 'color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']],
          ['view', ['fullscreen', 'codeview']]
        ]
      });
  });
</script>
</body>
</html>

