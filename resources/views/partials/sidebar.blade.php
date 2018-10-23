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
                @if(userHasPermission("listar_tipo_equipo"))
                <li id="liEquipments" class="nav-item">
                    <a href="{!!URL::to('/equipments')!!}" class="nav-link nav-toggle">
                      <i class="glyphicon glyphicon-barcode"></i>
                      <span class="title">Catálogo de equipos </span>
                    </a>
                </li>
                @endif
                @if(userHasPermission('listar_captura_info'))
                <li id="liAssets" class="nav-item">
                    <a href="{!!URL::to('/actives')!!}" class="nav-link nav-toggle">
                        <i class="icon-pencil"></i>
                        <span class="title">Captura de información</span>
                    </a>
                </li>
                @endif
                @if(userHasPermission("listar_cotizacion_servicios"))
                <li id="liQuotations" class="nav-item">
                    <a href="{!!URL::to('/quotations')!!}" class="nav-link nav-toggle">
                        <i class=" icon-calculator"></i>
                        <span class="title">Generar cotización de servicio</span>
                    </a>
                </li>
                @endif
                @if(userHasPermission("listar_consulta_servicio"))
                <li id="liServiceOrders" class="nav-item">
                    <a href="{!!URL::to('/service-orders')!!}" class="nav-link nav-toggle">
                        <i class="icon-bell"></i>
                        <span class="title">Consulta de servicios</span>
                    </a>
                </li>
                @endif
                @if(userHasPermission("generar_consulta_bitacora"))
                <li id="liServiceOrdersBinnacle" class="nav-item">
                    <a href="{!!route('reports.binnacle-service-orders')!!}" class="nav-link nav-toggle">
                        <i class="icon-book-open"></i>
                        <span class="title">Consulta de bitácora e historial de servicios</span>
                    </a>
                </li>
                 @endif
                <li id="liReports" class="nav-item">
                    <a href="{!!URL::to('/reports')!!}" class="nav-link nav-toggle">
                        <i class="icon-graph"></i>
                        <span class="title">Reportes</span>
                    </a>
                </li>
                @if(userHasPermission('listar_catalogo_correlativos'))
                <li id="liParts" class="nav-item">
                    <a href="{!!URL::to('/parts')!!}" class="nav-link nav-toggle">
                        <i class="far fa-bookmark"></i>
                        <span class="title">Catálogo de correlativos</span>
                    </a>
                </li>
                @endif
                @if(userHasPermission("listar_registro_incidencias"))
                <li id="liIncidents" class="nav-item">
                    <a href="{!!URL::to('/incidents')!!}" class="nav-link nav-toggle">
                        <i class="icon-note"></i>
                        <span class="title">Registro de incidencias</span>
                    </a>
                </li>
                @endif
                @if(userHasPermission("listar_consulta_atencion_incidencias"))
                <li id="liAid" class="nav-item">
                    <a href="{!!URL::to('/aid')!!}" class="nav-link nav-toggle">
                        <i class=" icon-clock"></i>
                        <span class="title">Consulta y atención de incidencias</span>
                    </a>
                </li>
                @endif
                <li id="liMaintenances" class="nav-item">
                    <a href="{!!URL::to('maintenances')!!}" class="nav-link nav-toggle">
                        <i class="  icon-wrench"></i>
                        <span class="title">Administración de mantenimientos programados</span>
                    </a>
                </li>
                <li id="liCatalogs" class="nav-item">
                    <a href="{!!URL::to('/catalogs')!!}" class="nav-link nav-toggle">
                        <i class=" icon-notebook"></i>
                        <span class="title">Catálogos</span>
                    </a>
                </li>
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
