<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Alat Musik' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .stat-card {
      background-image: linear-gradient(to bottom right, #e2c49f, #78716c, #3f3f3f);
      min-height: 160px;
    }
    
    .icon-container {
      background-color: #000;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
    }
    
    .sidebar {
      transition: transform 0.3s ease;
      position: fixed;
      margin-top: 5vh;
      height: 100vh;
      top: 0;
      left: 0;
      z-index: 20;
      background-color: #C9B194;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      transform: translateX(-100%);
    }

    .sidebar li:hover {
      background-color: #A08963;
    }
    
    .sidebar-open {
      transform: translateX(0);
    }
    
    .main-content {
      transition: margin-left 0.3s ease;
      margin-left: 0;
    }
    
    .sidebar-open + .main-content {
      margin-left: 150px;
    }
    
    @media (max-width: 768px) {
      .stat-card {
        min-height: 140px;
      }
      .sidebar-open + .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="bg-white-100">
@include('layouts.navbar')

  <!-- Sidebar -->
@include('layouts.sidebar')

  <!-- Main Content -->
@yield('content')

  <script>
    // Toggle sidebar
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    
    menuButton.addEventListener('click', (e) => {
      e.stopPropagation();
      sidebar.classList.toggle('sidebar-open');
    });
    
    // Close sidebar when clicking outside
    document.addEventListener('click', (event) => {
      if (!sidebar.contains(event.target) && !menuButton.contains(event.target) && sidebar.classList.contains('sidebar-open')) {
        sidebar.classList.remove('sidebar-open');
      }
    });
  </script>
</body>
</html>