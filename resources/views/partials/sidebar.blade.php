<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
  <!-- BEGIN SIDEBAR -->
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">
    @if (\Request::route()->getName()!= "Dashboard")
    <div class="menu-toggler sidebar-toggler center">
      <i class="fa fa-bars"></i>
    </div>
    @endif
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu page-header-fixed sidebarPadding" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
      <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
      <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
          <span></span>
        </div>
      </li>

      <!-- END SIDEBAR TOGGLER BUTTON -->
      @if (\Request::route()->getName()!= "Dashboard")
      @if(!user_can())

      @if( userHasPermission("listar_registro_incidencias") || userHasPermission("listar_consulta_servicio") || userHasPermission("listar_mantenimientos") || userHasPermission("listar_cotizacion_servicios"))
      <li id="liHelpDesk" class="nav-item">
        <a class="nav-link nav-toggle">
          <i class="icon-earphones-alt"></i>
          <span class="title not-select ">Help Desk</span>
          <span class="selected"></span>
        </a>
        <ul class="sub-menu">
          <span class="spanSubMenu"></span>
          @if(userHasPermission("listar_registro_incidencias") )
          <li class="nav-item">
            <a href="{!!URL::to('/incidents')!!}">
              <i class="icon-fire"></i>
              Incidents</a>
          </li>
          @endif
          @if(userHasPermission("listar_consulta_servicio") || userHasPermission("listar_cotizacion_servicios"))
          <li class="nav-item">
            <a href="{!!URL::to('/help_service')!!}" class="nav-link nav-toggle">
              <i class="icon-call-in"></i>
              Service</a>
          </li>
          @endif
          @if(userHasPermission("listar_mantenimientos") )
          <li class="nav-item">
            <a href="{!!URL::to('/maintenances')!!}" class="nav-link nav-toggle">
              <i class="icon-wrench"></i>
              Maintenance</a>
          </li>
          @endif
          {{-- @if(userHasPermission("listar_problemas") )
                    <li id="liProblems" class="nav-item">
                      <a href="{!!URL::to('/problems')!!}" class="nav-link nav-toggle">
                      <i class="icon-bell"></i>
                      Problems</a>
                    </li>
                    @endif --}}
        </ul>
      </li>

      @endif

      @if(userHasPermission('listar_captura_info') || userHasPermission("listar_catalogo_correlativos"))
      <li id="liAssets" class="nav-item">
        <a class="nav-link nav-toggle">
          <i class="icon-screen-desktop"></i>
          <span class="title not-select ">Assets</span>
          <span class="selected"></span>
        </a>
        <ul class="sub-menu">
          <span class="spanSubMenu"></span>


          @if(userHasPermission("listar_captura_info") )
          <li class="nav-item">
            <a href="{!!URL::to('/actives')!!}" class="nav-link nav-toggle">
              <i class=" icon-list"></i>
              Asset List</a>
          </li>
          @endif
          {{-- <li id="" class="nav-item" >
                    <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    Asset Groups</a>
                  </li> --}}
          @if(userHasPermission("listar_catalogo_correlativos") )
          <li class="nav-item">
            <a href="{!!URL::to('/parts')!!}" class="nav-link nav-toggle">
              <i class="icon-frame"></i>
              Parts brochure</a>
          </li>
          @endif
          {{-- <li id="" class="nav-item">
                    <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                    <i class="icon-check"></i>
                    Asset active </a>
                  </li>
                  <li id="" class="nav-item">
                    <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                    <i class="icon-close"></i>
                    Asset inactive </a>
                  </li> --}}
        </ul>
      </li>
      @endif

      @if(userHasPermission("generar_consulta_bitacora") || userHasPermission("descargar_consulta_bitacora") || userHasPermission("listar_consulta_atencion_incidencias") || userHasPermission("mostrar_consulta_atencion_incidencias") ||
      userHasPermission("generar_reporte_incidencias") || userHasPermission("exportar_reporte_incidencias") || userHasPermission("generar_reporte_tickets") ||userHasPermission("exportar_reporte_tickets") ||
      userHasPermission("generar_reporte_servicio") || userHasPermission("exportar_reporte_servicio"))
      <li id="liAnalitycs" class="nav-item">
        <a class="nav-link nav-toggle">
          <i class="icon-graph"></i>
          <span class="title not-select ">Analytics</span>
          <span class="selected"></span>
        </a>
        <ul class="sub-menu">
          <span class="spanSubMenu"></span>

          @if(userHasPermission("generar_consulta_bitacora"))
          <li class="nav-item">
            <a href="{!!route('reports.binnacle-service-orders')!!}" class="nav-link nav-toggle">
              <i class="icon-earphones-alt"></i>
              Services</a>
          </li>
          @endif

          @if(userHasPermission("listar_consulta_atencion_incidencias") || userHasPermission("generar_reporte_incidencias") )
          <li class="nav-item">
            <a href="{!!URL::to('/analytics_incident')!!}" class="nav-link nav-toggle">
              <i class=" icon-bubble "></i>
              Incidents</a>
          </li>
          @endif

          @if(userHasPermission("generar_reporte_tickets"))
          <li class="nav-item">
            <a href="{{route('reports.technician-tickets')}}" class="nav-link nav-toggle">
              <i class="icon-tag"></i>
              User Tickets</a>
          </li>
          @endif

          @if(userHasPermission("generar_reporte_servicio"))
          <li class="nav-item">
            <a href="{{route('reports.customer-service-orders')}}" class="nav-link nav-toggle">
              <i class=" icon-user-follow"></i>
              Customer service</a>
          </li>
          @endif

        </ul>
      </li>
      </li>
      @endif

      @if(userHasPermission("listar_catalogo_proveedores") || userHasPermission("listar_catalogo_personas") || userHasPermission("listar_catalogo_ubicaciones") || userHasPermission("listar_catalogo_clientes") ||
      userHasPermission("listar_catalogo_proyectos") || userHasPermission("listar_usuarios") || userHasPermission("listar_tipo_equipo") || userHasPermission("listar_roles") )

      <li id="liTools" class="nav-item">
        <a class="nav-link nav-toggle">
          <i class=" icon-settings"></i>
          <span class="title not-select ">Admin panel </span>
          <span class="selected"></span>
        </a>
        <ul class="sub-menu">
          <span class="spanSubMenu"></span>

          @if(userHasPermission("listar_catalogo_proveedores"))
          <li class="nav-item">
            <a href="{{route('providers.index')}}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-briefcase"></i>
              Suppliers</a>
          </li>
          @endif

          @if(userHasPermission("listar_catalogo_personas"))
          <li class="nav-item">
            <a href="{{route('persons.index')}}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-user"></i>
              People</a>
          </li>
          @endif

          @if(userHasPermission("listar_catalogo_ubicaciones"))
          <li class="nav-item">
            <a href="{{route('locations.index')}}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-map-marker"></i>
              Locations</a>
          </li>
          @endif

          @if(userHasPermission("listar_catalogo_clientes"))
          <li class="nav-item">
            <a href="{{route('customers.index')}}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-shopping-cart"></i>
              Customers</a>
          </li>
          @endif

          @if(userHasPermission("listar_catalogo_proyectos"))
          <li class="nav-item">
            <a href="{{route('projects.index')}}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-blackboard"></i>
              Projects</a>
          </li>
          @endif

          @if(userHasPermission("listar_tipo_equipo"))
          <li class="nav-item">
            <a href="{!!URL::to('/equipments')!!}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-barcode"></i>
              Equipment</a>
          </li>
          @endif

          @if(userHasPermission("listar_usuarios"))
          <li class="nav-item">
            <a href="{!!URL::to('/users')!!}" class="nav-link nav-toggle">
              <i class="glyphicon glyphicon-sunglasses"></i>
              Users</a>
          </li>
          @endif

          @if(userHasPermission("listar_roles"))
          <li class="nav-item">
            <a href="{!!URL::to('/roles')!!}" class="nav-link nav-toggle">
              <i class=" icon-users"></i>
              Roles</a>
          </li>
          @endif
        </ul>
      </li>
      @endif
      @else
      <li id="liCustomerIncidents" class="nav-item">
        <a href="{!!URL::to('/customerIncidents/' . Auth::user()->id)!!}" class="nav-link nav-toggle">
          <i class="fa fa-th-list"></i>
          <span class="title">Consulta de incidencias</span>
        </a>
      </li>
      @endif
      @endif
      <li class="nav-item footer-sidebar">
        <a style="min-height: 1px;" href="{{ url('/logout') }}" role="button" tabindex="0" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i>
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </li>
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
  </div>
  <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
