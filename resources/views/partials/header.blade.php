<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="{{ url('/') }}">
        <img src="{{ asset('/images/AntCMMS_2.png') }}" class="img-responsive" style="width: 90px;" alt="logo" class="logo-default" />
      </a>
      {{-- <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div> --}}
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    @if (\Request::route()->getName()!= "Desktop")
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
      <span></span>
    </a>
    @endif

    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="page-top" align="center">
      @php
      $name_route = explode(".", Request::route()->getName());
      $link = ucwords($name_route[0]);

      switch ($link) {
        case 'Persons':
          $link = 'Owners';
          break;
        case 'Equipments':
          $link = 'Equipments Module';
        break;
        case 'Actives':
          $link = 'Equipments';
        default:
          break;
      }
      @endphp
      <span class="saludo nombreVista">{{$link}}</span>
      <span id="saludo" class="saludo"></span>
      <span class="username username-hide-on-mobile saludo"> {!!Auth::user()->username!!} </span>

      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
          <!-- BEGIN QUICK SIDEBAR TOGGLER -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle displayLiDesktop" data-toggle="modal" data-target="#sidebar-right" data-hover="dropdown" data-close-others="true">
              <span class="username username-hide-on-mobile"> {!!Auth::user()->username!!} </span>
              <img src="https://stylesatlife.com/wp-content/uploads/2018/02/Hairstyles-For-Oval-Face-Men-1.jpg" class="img-circle fotoPerfil" alt="">
              <i class="glyphicon glyphicon-menu-down"></i>
            </a>
            {{-- <ul class="dropdown-menu dropdown-menu-default">
              <li>
                <a href="{{ url('/logout') }}" role="button" tabindex="0" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="icon-key"></i> Sign out
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul> --}}
        </li>
        <!-- END QUICK SIDEBAR TOGGLER -->
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
    </div>
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="modal fade right" id="sidebar-right" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body sidebarModal">
        <img src="https://stylesatlife.com/wp-content/uploads/2018/02/Hairstyles-For-Oval-Face-Men-1.jpg" class="img-circle sidebarFotoUser" alt="">
        <p class="username text-center sideBarModalUsername"> {!!Auth::user()->username!!} </p>
        <ul class="navMenu">
          <li id="" class="nav-item">
            <a href="/profile" class="nav-link nav-toggle">
              <i class="fa fa-user"></i>
              <span class="title not-select ">Profile</span>
            </a>
          </li>
          <li id="" class="nav-item">
            <a href="" class="nav-link nav-toggle">
              <i class="fa fa-envelope"></i>
              <span class="title not-select12">Messages</span>
            </a>
          </li>
          <li id="" class="nav-item">
            <a href="/settings" class="nav-link nav-toggle">
              <i class="icon-settings"></i>
              <span class="title not-select ">Settings</span>
            </a>
          </li>
          <li class="nav-item footer-sidebar" style="right: 0;">
            <a style="min-height: 1px;" href="{{ url('/logout') }}" role="button" tabindex="0" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <span class="title not-select ">Sign out</span>
              <i class="fa fa-sign-out"></i>
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<!-- END HEADER & CONTENT DIVIDER -->
