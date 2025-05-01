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
  <!-- Navbar -->
  <div class="bg-gray-200 w-full shadow-sm sticky top-0 z-30">
    <div class="navbar px-4">
      <div class="flex-1 items-center">
        <img src="{{ asset('Tak berjudul1_20250405135613.png') }}" alt="Logo" class="h-20">
      </div>
      <div class="flex-none">
        <div class="form-control hidden sm:block">
          <div class="input-group">
            <input type="text" placeholder="Cari" class="input input-bordered w-32 md:w-56 focus:outline-none" />
            <button class="btn btn-square bg-white border-gray-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <button id="menu-button" class="btn btn-ghost ml-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
    </svg>
  </button>

  <!-- Sidebar -->
  <div id="sidebar" class="sidebar">
    <ul class="menu p-4 pt-20">
      <li class="mb-2"><a href="/dashboard" class="font-medium">Dasbor</a></li>
      <li class="mb-2"><a href="/alatmusik" class="font-medium">Alat Musik</a></li>
      <li class="mb-2"><a href="#" class="font-medium">Menu Lain</a></li>
      <li class="mt-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="font-medium">
            Logout
          </a>
        </form>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    @yield('container')
  </div>

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