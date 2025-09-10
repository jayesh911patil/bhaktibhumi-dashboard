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
        <div data-i18n="Analytics">Dashboard </div>
      </a>
    </li>

     <li
      class="menu-item {{ request()->routeIs('dharamshala', 'add-dharamshala', 'edit-dharamshala') ? 'active' : '' }}">
      <a href="{{ route('dharamshala') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div data-i18n="Analytics">Registrations</div>
      </a>
    </li>

      <li
      class="menu-item ">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div data-i18n="Analytics">Dharamshala</div>
      </a>
    </li>


    <li
      class="menu-item {{ request()->routeIs('users') ? 'active' : '' }}">
      <a href="{{ route('users') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Analytics">Users</div>
      </a>
    </li>

     <li
      class="menu-item ">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Analytics">Bookings</div>
      </a>
    </li>

     <li
      class="menu-item {{ request()->routeIs('rooms', 'add-rooms') ? 'active' : '' }}">
      <a href="{{ route('rooms') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Analytics">Add Room</div>
      </a>
    </li>

       <li
      class="menu-item {{ request()->routeIs('users') ? 'active' : '' }}">
      <a href="{{ route('users') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Analytics">Room Types</div>
      </a>
    </li>



    <li
      class="menu-item  {{ request()->routeIs('popular-rituals', 'add-popular-rituals', 'edit-popular-rituals') ? 'active' : '' }}">
      <a href="{{ route('popular-rituals') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-star"></i>
        <div data-i18n="Analytics">Popular Rituals</div>
      </a>
    </li>

    <li
      class="menu-item  {{ request()->routeIs('partner-with-us', 'edit-partner-with-us', 'partner-with-us-data') ? 'active' : '' }}">
      <a href="{{ route('partner-with-us') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Analytics">Partner With Us</div>
      </a>
    </li>
  </ul>

</aside>
