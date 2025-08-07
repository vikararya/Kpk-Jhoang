<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kpk Jhoang</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background:rgb(4, 10, 30); }
        .cta-btn { color:rgb(0, 0, 0); }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background:rgb(1, 1, 3); }
        .nav-item:hover { background:rgb(5, 110, 29); }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
<aside class="relative h-screen w-96 hidden sm:block shadow-xl bg-cover bg-sidebar bg-center" 
      >
               <div class="p-6">
            <a href="index.html" class="text-white text-lg font-semibold uppercase hover:text-gray-300">Admin Kpk Jhoang</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('dashboard') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('dashboard') ? 'active-nav-link' : '' }}">
    <i class="fas fa-tachometer-alt mr-3"></i>
    Dashboard
</a>
            <a href="{{ route('menus.index') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('menus.*') ? 'active-nav-link' : '' }}">
   <i class="fas fa-utensils mr-3"></i>
   Menu
</a>
            <a href="{{ route('categories.index') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('categories.*') ? 'active-nav-link' : '' }}">
   <i class="fas fa-th-list mr-3"></i>
   Kategori
</a>
<a href="{{ route('orders.index') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('orders.index') ? 'active-nav-link' : '' }}">
   <i class="fas fa-concierge-bell mr-3"></i>
   Pesanan
</a>

<a href="{{ route('orders.history') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('orders.history') ? 'active-nav-link' : '' }}">
   <i class="fas fa-history mr-3"></i>
   Riwayat Pemesanan
</a>

            <a href="{{ route('rekening.index') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('rekening.*') ? 'active-nav-link' : '' }}">
   <i class="fas fa-credit-card mr-3"></i>
   Rekening Kpk Jhoang
</a>
<a href="{{ route('untukuser.index') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('untukuser.*') ? 'active-nav-link' : '' }}">
   <i class="fas fa-user mr-3"></i>
   Untuk user
</a>
<a href="{{ route('saran.index') }}"
   class="flex items-center py-4 pl-6 nav-item text-white opacity-75 hover:opacity-100 {{ request()->routeIs('saran.*') ? 'active-nav-link' : '' }}">
   <i class="fas fa-comments mr-3"></i>
   Saran & Masukkan
</a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <header class="w-full items-center bg-green-700 py-5 px-6 hidden sm:flex">
        <div class="w-1/2"></div>
        <div class="w-1/2 flex justify-end items-center">
            <!-- Tautan Sign Out -->
            <a href="{{ route('logout') }}"
               class="text-white font-bold hover:underline"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign Out
            </a>

            <!-- Form Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </header>


           <!-- Mobile Header & Nav -->
           <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="index.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Menu
                </a>
                <a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Kategori
                </a>
                <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-align-left mr-3"></i>
                    Pesanan
                </a>
                <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tablet-alt mr-3"></i>
                    Riwayat Pesanan
                </a>
                <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-calendar mr-3"></i>
                    Untuk User
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    My Account
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden flex flex-col">
            <main class="w-full flex-grow p-1 -mt-5">   

        <!-- Page Content -->
        <main class="w-full flex-grow p-3 overflow-y-auto">
            @yield('content')
        </main>
   
  <script>
    // Toggle Sidebar on Mobile
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.lg\\:hidden');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
  </script>
                      

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

</body>
</html>