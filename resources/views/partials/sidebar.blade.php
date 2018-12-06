<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            @if(!user_can())

                @if( userHasPermission("listar_registro_incidencias") || userHasPermission("listar_consulta_servicio") )
                <li id="liHelpDesk" class="nav-item">
                    <a  class="nav-link nav-toggle">
                      <i class="icon-earphones-alt"></i>
                      <span class="title not-select ">Help Desk</span>
                    </a>
                    <ul class="sub-menu">

                      @if(userHasPermission("listar_registro_incidencias") )
        							<li id="liIncidents" class="nav-item">
        								<a href="{!!URL::to('/incidents')!!}">
        								<i class="icon-fire"></i>
        								Incidents</a>
                      </li>
                      @endif
                      @if(userHasPermission("listar_consulta_servicio") )
        							<li id="liServiceOrders" class="nav-item" >
        								<a href="{!!URL::to('/help_service')!!}" class="nav-link nav-toggle">
        								<i class="icon-call-in"></i>
        								Service</a>
                      </li>
                      @endif
                      @if(userHasPermission("crear_mantenimiento_programado") )
        							<li id="liMaintenances" class="nav-item">
        								<a href="{!!URL::to('/maintenances')!!}" class="nav-link nav-toggle">
        								<i class="icon-wrench"></i>
                        Maintenance</a>
                      </li>
                      @endif
                      @if(userHasPermission("listar_problemas") )
        							<li id="liProblems" class="nav-item">
        								<a href="{!!URL::to('/problems')!!}" class="nav-link nav-toggle">
        								<i class="icon-bell"></i>
        								Problems</a>
                      </li>
                      @endif
        						</ul>
                  </li>
                </li>
                @endif

                @if(userHasPermission('listar_captura_info'))
                <li id="liAssets" class="nav-item">
                  <a class="nav-link nav-toggle">
                      <i class="icon-screen-desktop"></i>
                      <span class="title not-select ">Assets</span>
                  </a>
                  <ul class="sub-menu">
                    <li id="liAssetsList" class="nav-item">
                      <a href="{!!URL::to('/actives')!!}" class="nav-link nav-toggle">
                      <i class=" icon-list"></i>
                      Asset List</a>
                    </li>
                    <li id="" class="nav-item" >
                      <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                      <i class="icon-layers"></i>
                      Asset Groups</a>
                    </li>

                    <li id="liParts" class="nav-item">
                      <a href="{!!URL::to('/parts')!!}" class="nav-link nav-toggle">
                      <i class="icon-frame"></i>
                      Parts brochure</a>
                    </li>
                    <li id="" class="nav-item">
                      <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                      <i class="icon-check"></i>
                      Asset active </a>
                    </li>
                    <li id="" class="nav-item">
                      <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                      <i class="icon-close"></i>
                      Asset inactive </a>
                    </li>
                  </ul>
                </li>
                @endif


                @if(userHasPermission("listar_tipo_equipo"))
                <li id="liAnalitycs" class="nav-item">
                    <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                      <i class="icon-graph"></i>
                      <span class="title not-select ">Analytics</span>
                    </a>
                    <ul class="sub-menu">
                      <li id="liServiceOrdersBinnacle" class="nav-item">
                        <a href="{!!route('reports.binnacle-service-orders')!!}" class="nav-link nav-toggle">
                        <i class="icon-earphones-alt"></i>
                        Services</a>
                      </li>
                      <li id="liAnalyticsIncidents" class="nav-item" >
                        <a href="{!!URL::to('/analytics_incident')!!}" class="nav-link nav-toggle">
                        <i class=" icon-bubble "></i>
                        Incidents</a>
                      </li>

                      <li id="liReportTiket" class="nav-item">
                        <a href="{{route('reports.technician-tickets')}}" class="nav-link nav-toggle">
                        <i class="icon-tag"></i>
                        User Tickets</a>
                      </li>
                      <li id="liReportService" class="nav-item">
                        <a href="{{route('reports.customer-service-orders')}}" class="nav-link nav-toggle">
                        <i class=" icon-user-follow"></i>
                        Customer service</a>
                      </li>
                    </ul>
                  </li>
                </li>
                @endif

                @if(userHasPermission("listar_tipo_equipo"))
                <li id="liTools" class="nav-item">
                    <a href="{!!URL::to('/')!!}" class="nav-link nav-toggle">
                        <i class=" icon-settings"></i>
                        <span class="title not-select ">Admin panel </span>
                    </a>
                    <ul class="sub-menu">
                      <li id="liSuppliers" class="nav-item">
                        <a href="{{route('providers.index')}}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-briefcase"></i>
                        Suppliers</a>
                      </li>
                      <li id="liPeople" class="nav-item" >
                        <a href="{{route('persons.index')}}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-user"></i>
                        People</a>
                      </li>
                      <li id="liLocations" class="nav-item">
                        <a href="{{route('locations.index')}}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-map-marker"></i>
                        Locations</a>
                      </li>
                      <li id="liCustomer" class="nav-item">
                        <a href="{{route('customers.index')}}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        Customers</a>
                      </li>
                      <li id="liProjects" class="nav-item">
                        <a href="{{route('projects.index')}}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-blackboard"></i>
                        Proyects</a>
                      </li>
                      <li id="liEquipments" class="nav-item">
                        <a href="{!!URL::to('/equipments')!!}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-barcode"></i>
                        Equipment</a>
                      </li>
                      <li id="liUsers" class="nav-item">
                        <a href="{!!URL::to('/users')!!}" class="nav-link nav-toggle">
                        <i class="glyphicon glyphicon-sunglasses"></i>
                        Users</a>
                      </li>
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
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
