 <!-- Sidebar -->

 @php
     $active = 'menu-item active';
     $nonActive = 'menu-item';
 @endphp
 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
     <div class="app-brand demo">
         <a href="index.html" class="app-brand-link">
             <img src="{{ asset('storage/image/tutwuri1.png') }}" alt="" width="30px">
             <span class="app-brand-text demo menu-text fw-bolder ms-2">tadika</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <!--Menu-->
     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="{{ Route::is('admin.dashboard') ? $active : $nonActive }}">
             <a href="{{ route('admin.dashboard') }}" class="menu-link ">
                 <i class="menu-icon tf-icons bx bx-home"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>

         <!-- Layouts -->
         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Settings</span>
         </li>

         <!--Data User-->
         <li class="{{ Route::is('admin.user.*') ? $active : $nonActive }}">
             <a href="{{ route('admin.user.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-user"></i>
                 <div data-i18n="Analytics">Data User</div>
             </a>
         </li>

         <!--Data Siswa-->
         <li class="{{ Route::is('admin.murid.*') ? $active : $nonActive }}">
             <a href="{{ route('admin.murid.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-user"></i>
                 <div data-i18n="Analytics">Data Siswa</div>
             </a>
         </li>


         <!--Data Wali Murid-->
         <li class="{{ Route::is('admin.walimurid.*') ? $active : $nonActive }}">
             <a href="{{ route('admin.walimurid.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-user"></i>
                 <div data-i18n="Analytics">Data Wali Murid</div>
             </a>
         </li>

         <!--Data Biaya-->
         <li class="{{ Route::is('admin.biaya.*') ? $active : $nonActive }}">
             <a href="{{ route('admin.biaya.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-user"></i>
                 <div data-i18n="Analytics">Data Angkatan</div>
             </a>
         </li>

         <!--Account setting-->
         <li
             class="menu-item {{ Route::is('admin.profile', 'admin.instansi.index', 'admin.bank.edit') ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-dock-top"></i>
                 <div data-i18n="Account Settings">Account Setting</div>
             </a>
             <ul class="menu-sub">
                 <li class="{{ Route::is('admin.profile') ? $active : $nonActive }}">
                     <a href="{{ route('admin.profile') }}" class="menu-link">
                         <div data-i18n="Without menu">Profile</div>
                     </a>
                 </li>
                 <li class="{{ Route::is('admin.instansi.index', 'admin.bank.edit') ? $active : $nonActive }}">
                     <a href="{{ route('admin.instansi.index') }}" class="menu-link">
                         <div data-i18n="Without menu">Instansi</div>
                     </a>
                 </li>
             </ul>
         </li>

         <!-- Layouts -->

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">DATA TRANSAKSI</span>
         </li>
         <!--Data Tagihan-->
         <li class="{{ Route::is('admin.tagihan.*') ? $active : $nonActive }}">
             <a href="{{ route('admin.tagihan.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                 <div data-i18n="Without menu">Data Tagihan</div>
             </a>
         </li>
         <!--Data Pembayaran-->
         <li class="{{ Route::is('admin.pembayaran', 'admin.pembayaran.detail') ? $active : $nonActive }}">
             <a href="{{ route('admin.pembayaran') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-credit-card-front"></i>

                 <div data-i18n="Without menu">Data Pembayaran</div>
             </a>
         </li>
         <!--Laporan-->
         <li class="{{ Route::is('admin.laporan.index') ? $active : $nonActive }}">
             <a href="{{ route('admin.laporan.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bxs-report"></i>

                 <div data-i18n="Without menu">Laporan</div>
             </a>
         </li>
     </ul>
 </aside>
