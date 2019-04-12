@extends('layouts.master')

@section("styles")

{!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

<div id="dashboard" class="row flex_icon">
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Dashboard</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div id="dashboards_tile" class="tiles">
            <a href="/dashboard">
              <div class="tile bgDesktop">
                <div class="tile-body">
                  <i class="iconos-Dashboard-azul"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>



  @if( userHasPermission("listar_registro_incidencias") || userHasPermission("listar_consulta_servicio" ) || userHasPermission("listar_mantenimientos") ||userHasPermission("listar_cotizacion_servicios") )
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Help Desk</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div id="incidents_tile" class="tiles">
            <li class="dropdown dropdown-user">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <div class="tile bgDesktop">
                  <div class="tile-body">
                    <i class="iconos-Help-DeskAzul"></i>
                  </div>
                </div>
              </a>
              <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                @if(userHasPermission("listar_registro_incidencias") )
                <li>
                  <a href="{!!URL::to('/incidents')!!}">
                    <i class="icon-fire"></i>
                    <span>Incidents</span>
                  </a>
                </li>
                @endif
                @if(userHasPermission("listar_consulta_servicio") || userHasPermission("listar_cotizacion_servicios"))
                <li>
                  <a href="{!!URL::to('/help_service')!!}">
                    <i class="icon-call-in"></i>
                    <span>Service</span>
                  </a>
                </li>
                @endif
                @if(userHasPermission("listar_mantenimientos"))
                <li>
                  <a href="{!!URL::to('maintenances')!!}">
                    <i class="icon-wrench"></i>
                    <span>Maintenance</span>
                  </a>
                </li>
                @endif
              </ul>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif


  @if(userHasPermission('listar_captura_info') || userHasPermission('listar_catalogo_correlativos'))
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Assets</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div class="tiles">
            <a href="">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-AssetsAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_captura_info") )
                  <li>
                    <a href="{!!URL::to('/actives')!!}">
                      <i class="icon-list"></i>
                      <span>Equipments</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_tipo_equipo"))
                  <li>
                    <a href="{!!URL::to('/equipments')!!}">
                      <i class="glyphicon glyphicon-barcode"></i>
                      <span>Equipments module</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_correlativos") )
                  <li>
                    <a href="{!!URL::to('/parts')!!}">
                      <i class="icon-frame"></i>
                      <span>Parts</span>
                    </a>
                  </li>
                  @endif
                </ul>
            </a>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif

  @if(userHasPermission("generar_consulta_bitacora") || userHasPermission("descargar_consulta_bitacora") || userHasPermission("listar_consulta_atencion_incidencias") || userHasPermission("mostrar_consulta_atencion_incidencias") ||
  userHasPermission("generar_reporte_incidencias") || userHasPermission("exportar_reporte_incidencias") || userHasPermission("generar_reporte_tickets") ||userHasPermission("exportar_reporte_tickets") || userHasPermission("generar_reporte_servicio")
  || userHasPermission("exportar_reporte_servicio"))
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Analytics</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div class="tiles">
            <a href="">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-AnalyticsAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_captura_info") )
                  <li>
                    <a href="{!!route('reports.binnacle-service-orders')!!}">
                      <i class="icon-earphones-alt"></i>
                      <span>Services</span>
                    </a>
                  </li>
                  @endif
                  <li>
                    <a href="{!!URL::to('/analytics_incident')!!}">
                      <i class="icon-bubble "></i>
                      <span>Incidents</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('reports.technician-tickets')}}">
                      <i class="icon-tag"></i>
                      <span>User Tikets</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('reports.customer-service-orders')}}">
                      <i class="icon-user-follow"></i>
                      <span>Customer Service</span>
                    </a>
                  </li>
                </ul>
            </a>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif

  @if(userHasPermission("listar_catalogo_proveedores") || userHasPermission("listar_catalogo_personas") || userHasPermission("listar_catalogo_ubicaciones") || userHasPermission("listar_catalogo_clientes") ||
  userHasPermission("listar_catalogo_proyectos") || userHasPermission("listar_usuarios") || userHasPermission("listar_tipo_equipo") || userHasPermission("listar_roles"))
  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
    <!-- BEGIN Portlet PORTLET-->
    <ul class="portlet nav">
      <div class="tile-object">
        <div class="text-center">
          <span class="titleDesktop">Settings</span>
        </div>
      </div>
      <div id="flex_icon" class="portlet-title">
        <div class="caption tools">
          <div class="tiles">
            <a href="">
              <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <div class="tile bgDesktop">
                    <div class="tile-body">
                      <i class="iconos-SettingsAzul"></i>
                    </div>
                  </div>
                </a>
                <ul class="dropdownDesktop dropdown-menu dropdown-menu-default">
                  @if(userHasPermission("listar_catalogo_proveedores"))
                  <li>
                    <a href="{{route('providers.index')}}">
                      <i class="glyphicon glyphicon-briefcase"></i>
                      <span>Suppliers</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_personas"))
                  <li>
                    <a href="{{route('persons.index')}}">
                      <i class="glyphicon glyphicon-user"></i>
                      <span>People</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_ubicaciones"))
                  <li>
                    <a href="{{route('locations.index')}}">
                      <i class="glyphicon glyphicon-map-marker"></i>
                      <span>Locations</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_clientes"))
                  <li>
                    <a href="{{route('customers.index')}}">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                      <span>Customers</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_catalogo_proyectos"))
                  <li>
                    <a href="{{route('projects.index')}}">
                      <i class="glyphicon glyphicon-blackboard"></i>
                      <span>Projects</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_usuarios"))
                  <li>
                    <a href="{!!URL::to('/users')!!}">
                      <i class="glyphicon glyphicon-sunglasses"></i>
                      <span>Users</span>
                    </a>
                  </li>
                  @endif
                  @if(userHasPermission("listar_roles"))
                  <li>
                    <a href="{!!URL::to('/roles')!!}">
                      <i class="icon-users"></i>
                      <span>Roles</span>
                    </a>
                  </li>
                  @endif
                </ul>

            </a>
          </div>
        </div>
      </div>
      </li>
    </ul>
    <!-- END Portlet PORTLET-->
  </div>
  @endif
</div>

<div class="row rowDesktop">
  <span class="tituloDesktop">Start</span>
  <div id="fecha" class="infoDesktop"></div>
  <div id="reloj" class="infoDesktop"></div>
  <div class="infoDesktop">
    <i class="wi wi-day-sunny"></i>
    <span class="degree">0</span>
    <span style="margin-left: 5px;" id="scaleP">C</span>
    <p style="display: none;">Location</p>
  </div>
</div>

<div class="row rowDesktop2">
  <span class="tituloDesktop">Stats</span>
  <div class="infoDesktop">Tickets vencidos: </div>
  <div class="infoDesktop">Tickets abiertos: </div>
  <div class="infoDesktop">Tickets en curso: </div>
</div>

{{-- @if(userHasPermission("listar_roles"))
  <div class="row content_container">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $chart_technician->container() !!}
        </div>
    </div>
  </div>
  @endif

<div class="row">
    {!! $chart->container() !!}
  </div>

<div class="row">
      {!! $chart_line->container() !!}
  </div>

<div class="row">
      {!! $chart_pie->container() !!}
  </div>


<div class="row">
      {!! $chart_technician->container() !!}
  </div>

<div class="row content_container">
    <div class="col-md-12">
      <div class="portlet light portlet-fit bordered">
        {!! $resolution->container() !!}
      </div>
    </div>
  </div>

  <div class="row content_container">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
          {!! $tickets->container() !!}
        </div>
    </div>
  </div> --}}

@endsection

@section("scripts")

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>


{!! $chart->script() !!}

{!! $chart_line->script() !!}

{!! $chart_pie->script() !!}

{!! $chart_pie_hig->script() !!}

{!! $chart_technician->script() !!}

{!! $resolution->script() !!}

{!! $tickets->script() !!} --}}

<script>
  // document.getElementById("incidents_tile").style.color = "blue";

  document.getElementById("incidents_tile").addEventListener("click", function(event) {
    // display the current click count inside the clicked div
    // event.target.textContent = "click count: " + event.detail;

    // document.getElementById("rebote").style.color = "blue";
  }, false);


  // ### Fecha actual en el dashboard ###

  function fechaActual() {

    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();

    if (day < 10) {
      day = '0' + day
    }
    if (month < 10) {
      month = '0' + month
    }

    var out = document.getElementById("fecha");
    out.innerHTML = month + "/" + day + "/" + year;

  }

  fechaActual();

  // ### Hora actual en el dashboard ###

  function horaActual() {

    var today = new Date();

    var h = today.getHours(); // 0 - 23
    var m = today.getMinutes(); // 0 - 59
    var s = today.getSeconds(); // 0 - 59
    var session = "AM";

    if (h == 0) {
      h = 12;
    }

    if (h > 12) {
      h = h - 12;
      session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("reloj").innerText = time;
    document.getElementById("reloj").textContent = time;

    setTimeout(horaActual, 1000);

  }

  horaActual();


  let Weather = {
    location: "",
    sunrise: undefined,
    sunset: undefined,
    now: {
      temp: 0,
      weather: ""
    },
    forecast: [{
        temp: 0,
        weather: "",
        hour: ""
      },
      {
        temp: 0,
        weather: "",
        hour: ""
      },
      {
        temp: 0,
        weather: "",
        hour: ""
      },
      {
        temp: 0,
        weather: "",
        hour: ""
      },
      {
        temp: 0,
        weather: "",
        hour: ""
      }
    ]
  };
  const wiIcons = {
    "01d": "wi-day-sunny",
    "01n": "wi-night-clear",
    "02d": "wi-day-sunny-overcast",
    "02n": "wi-night-alt-partly-cloudy",
    "03d": "wi-day-cloudy",
    "03n": "wi-night-alt-cloudy",
    "04d": "wi-day-cloudy-high",
    "04n": "wi-night-alt-cloudy-high",
    "09d": "wi-day-sprinkle",
    "09n": "wi-night-alt-sprinkle",
    "10d": "wi-day-rain",
    "10n": "wi-night-alt-rain",
    "11d": "wi-day-thunderstorm",
    "11n": "wi-night-alt-thunderstorm",
    "13d": "wi-day-snow",
    "13n": "wi-night-alt-snow",
    "50d": "wi-day-fog",
    "50n": "wi-night-fog"
  };

  function truncateDecimal(num) {
    let ret = new String(num).split(".");
    if (ret.length > 1) ret = ret[0] + "." + ret[1][0];
    else ret = ret[0];
    return ret;
  }

  const getLocation = (options = {}) =>
    new Promise(function(resolve, reject) {
      if (navigator.geolocation)
        return navigator.geolocation.getCurrentPosition(resolve, reject, options);
      else reject();
    });

  function updateWeather(json) {
    const isDay =
      new Date(json.sys.sunrise * 1000).getHours() < new Date().getHours() &&
      new Date().getHours() < new Date(json.sys.sunset * 1000).getHours();

    Weather = {
      ...Weather,
      location: json.name,
      isDay,
      now: {
        temp: json.main.temp,
        weather: json.weather[0].icon
      }
    };
  }

  const toAmPm = hour24 =>
    hour24 >= 12 ?
    (hour24 === 12 ? hour24 : hour24 - 12) + "PM" :
    (hour24 === 0 ? 12 : hour24) + "AM";

  const updateForecast = json =>
    // get the weather until end of Weather.forecast is reached
    json.list.every(
      ({
        main: {
          temp
        },
        weather: [{
          icon: weather
        }],
        dt_txt: time
      }, index) => {
        Weather.forecast[index] = {
          temp,
          weather,
          hour: toAmPm(new Date(time).getHours())
        };
        return index < Weather.forecast.length - 1;
      }
    );

  // URL for weather API
  const weatherURL = (lat, lon) =>
    `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=fc9c2f0009a8329f2ac436eca2267b63`;
  // Get the current weather
  const getWeather = (lat, lon) =>
    fetch(weatherURL(lat, lon)).then(response => response.json());

  // URL for forecast API
  const forecastURL = (lat, lon) =>
    `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&units=metric&appid=fc9c2f0009a8329f2ac436eca2267b63`;
  // Get the forecast, contains data for 5 days (I think)
  const getForecast = (lat, lon) =>
    fetch(forecastURL(lat, lon)).then(response => response.json());

  function updateScreen() {
    let wc = Weather.now.weather,
      icon = document.querySelector("div.infoDesktop > i"),
      temperature = document.querySelector("div.infoDesktop > span.degree"),
      location = document.querySelector("div.infoDesktop > span"),
      hours = document.getElementsByClassName("hour");
    icon.classList = "wi" + " " + wiIcons[wc];
    location.textContent = Weather.location;
    temperature.textContent = truncateDecimal(Weather.now.temp);
  }

  getLocation().then(pos =>
    getWeather(pos.coords.latitude, pos.coords.longitude)
    .then(
      r =>
      updateWeather(r) |
      getForecast(pos.coords.latitude, pos.coords.longitude)
      .then(r => updateForecast(r))
      .then(() => updateScreen())
    )
    .catch(r => console.log(r))
  );
</script>
@endsection
