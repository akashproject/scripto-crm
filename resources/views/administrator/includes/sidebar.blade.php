<!-- Menu -->
   <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
      <a href="{{ route('admin-dashboard') }}" class="app-brand-link">
         
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
         <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item active">
            <a href="{{ route('admin-dashboard') }}" class="menu-link">
               <i class="menu-icon tf-icons bx bx-home-circle"></i>
               <div data-i18n="Analytics">Dashboard</div>
            </a>
         </li>

         <!-- Layouts -->
         <li class="menu-item">
            <a href="{{ route('website') }}" class="menu-link">
               <i class="menu-icon tf-icons bx bx-globe"></i>
               <div data-i18n="globe">Visit Site</div>
            </a>
         </li>
         <li class="menu-header small text-uppercase"><span class="menu-header-text">Apparence</span></li>
         <li class="menu-item">
            <a href="{{ route('admin-media') }}" class="menu-link">
               <i class="menu-icon tf-icons bx bx-image"></i>
               <div data-i18n="Settings">Media Library</div>
            </a>
         </li>
         
         <li class="menu-item">
            <a href="{{ route('admin-settings') }}" class="menu-link">
               <i class="menu-icon tf-icons bx bx-cog"></i>
               <div data-i18n="Settings">Settings</div>
            </a>
         </li>
         
      </ul>
   </aside>
<!-- / Menu -->