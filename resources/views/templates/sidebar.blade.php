 <aside class="main-sidebar sidebar-light-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard') }}" class="brand-link bg-primary bg-light">

         <img src="{{ Storage::url($setting->logo_aplikasi ?? '') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">{{ $setting->nama_singkatan ?? config('app.name') }}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 @if (auth()->user()->path_image == 'default.jpg')
                     <img src="{{ asset('assets/images/not.png') }}" class="img-circle elevation-2" alt="User Image">
                 @else
                     <img src="{{ Storage::url(auth()->user()->path_image ?? '') }}" class="img-circle elevation-2"
                         alt="User Image">
                 @endif
             </div>
             <div class="info">
                 <a href="javascript:void(0)" class="d-block">{{ auth()->user()->name }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">

                 <li class="nav-item">
                     <a href="{{ route('dashboard') }}"
                         class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>

                 @if (auth()->user()->hasRole('admin'))
                     <li class="nav-header">MASTER DATA</li>
                 @else
                     <li class="nav-header">MANAJEMEN DATA</li>
                 @endif

                 @if (auth()->user()->hasRole('admin'))
                     <li class="nav-item">
                         <a href="{{ route('category.index') }}" class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                             <i class="nav-icon fas fa-cube"></i>
                             <p>
                                 Kategori
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->is('admin/supplier') ? 'active' : '' }}">
                             <i class="nav-icon fas fa-user-alt"></i>
                             <p>
                                 Supplier
                             </p>
                         </a>
                     </li>
                 @endif

                 @if (auth()->user()->hasRole('admin'))
                     <li class="nav-header">PENGATURAN APLIKASI</li>
                     <li class="nav-item">
                         <a href="" class="nav-link {{ request()->is('admin/setting') ? 'active' : '' }}">
                             <i class="nav-icon fas fa-cogs"></i>
                             <p>
                                 Setting
                             </p>
                         </a>
                     </li>
                 @endif

                 {{-- <li class="nav-header">MANAJEMEN AKUN</li>
                 <li class="nav-item">
                     <a href="{{ route('profile.show') }}"
                         class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-user"></i>
                         <p>
                             Profil
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('profile.show.password') }}"
                         class="nav-link {{ request()->is('user/profile/password') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-unlock"></i>
                         <p>
                             Ubah Password
                         </p>
                     </a>
                 </li> --}}

                 <li class="nav-item">
                     <a href="javascript:void(0)" class="nav-link"
                         onclick="document.querySelector('#form-logout').submit()">
                         <i class="nav-icon fas fa-sign-in-alt"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                     <form action="{{ route('logout') }}" method="post" id="form-logout">
                         @csrf
                     </form>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
