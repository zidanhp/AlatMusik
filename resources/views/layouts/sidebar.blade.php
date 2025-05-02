<div id="sidebar" class="sidebar">
    <ul class="menu p-4 pt-20">
      <li class="mb-2"><a href="dashboard" class="font-medium">Dasbor</a></li>
      <li class="mb-2"><a href="/alatmusik" class="font-medium">Alat Musik</a></li>
      <li class="mb-2"><a href="/dashboard/orders" class="font-medium">Pemesanan</a></li>
      <li class="mb-2"><a href="/alatmusik" class="font-medium">Peminjaman</a></li>
      <li class="mb-2"><a href="/alatmusik" class="font-medium">Pengembalian</a></li>
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