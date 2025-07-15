<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <div class="app-brand mb-3">
        <div>
          <img type="image" src="{{ asset('assets/assets/img/logo/LogoForWebsite.png') }}" class="login_logo" alt="">
        </div>
      </div>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard   </div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('dharamshala', 'add-dharamshala') ? 'active' : '' }}">
      <a href="{{ route('dharamshala') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div data-i18n="Analytics">Dharamshala</div>
      </a>
    </li>
  </ul>

</aside>