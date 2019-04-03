@extends('layouts.master')

@section("styles")

<style>
  #pastel {
    width: 100%;
    height: 500px;
  }

  #barras {
    width: 100%;
    height: 500px;
  }

  #iconos {
    width: 100%;
    height: 500px;
  }

  #horizontal {
    width: 100%;
    height: 500px;
  }
</style>

@endsection

@section('page-content')

<div class="row content_container paddingForm">
  <div class="row">
    <div class="col-md-6">
      <div class="portlet light portlet-fit bordered">
        <div class="portlet-title topForm"></div>
        <p class="titleForm">Gráfica 1</p>
        <div id="pastel"></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="portlet light portlet-fit bordered">
        <div class="portlet-title topForm"></div>
        <p class="titleForm">Gráfica 2</p>
        <div id="barras"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="portlet light portlet-fit bordered">
        <div class="portlet-title topForm"></div>
        <p class="titleForm">Gráfica 3</p>
        <div id="iconos"></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="portlet light portlet-fit bordered">
        <div class="portlet-title topForm"></div>
        <p class="titleForm">Gráfica 4</p>
        <div id="horizontal"></div>
      </div>
    </div>
  </div>
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
</div>
</div>

@endsection

@section("scripts")

<script>

$(document).ready(function() {
  $("#liDashboard").addClass("active");
});
  // Themes begin
  // am4core.useTheme(am4themes_material);
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create("pastel", am4charts.PieChart);
  var chart2 = am4core.create("barras", am4charts.XYChart);
  var chart3 = am4core.create("iconos", am4charts.XYChart);
  var chart4 = am4core.create("horizontal", am4charts.SlicedChart);

  // Create pie series
  var series = chart.series.push(new am4charts.PieSeries());
  series.dataFields.value = "litres";
  series.dataFields.category = "country";

  // series.colors.list = [
  //   am4core.color("#845EC2"),
  //   am4core.color("#D65DB1"),
  //   am4core.color("#FF6F91"),
  //   am4core.color("#FF9671"),
  //   am4core.color("#FFC75F"),
  //   am4core.color("#F9F871"),
  // ];
  //
  // chart2.colors.list = [
  //   am4core.color("#845EC2"),
  //   am4core.color("#D65DB1"),
  //   am4core.color("#FF6F91"),
  //   am4core.color("#FF9671"),
  //   am4core.color("#FFC75F"),
  //   am4core.color("#F9F871"),
  // ];

  // Add data
  chart.data = [{
    "country": "Lithuania",
    "litres": 501.9
  }, {
    "country": "Czech Republic",
    "litres": 301.9
  }, {
    "country": "Ireland",
    "litres": 201.1
  }, {
    "country": "Germany",
    "litres": 165.8
  }, {
    "country": "Australia",
    "litres": 139.9
  }, {
    "country": "Austria",
    "litres": 128.3
  }, {
    "country": "UK",
    "litres": 99
  }, {
    "country": "Belgium",
    "litres": 60
  }, {
    "country": "The Netherlands",
    "litres": 50
  }];

  // And, for a good measure, let's add a legend
  chart.legend = new am4charts.Legend();

  chart2.data = [{
    "year": "2003",
    "europe": 2.5,
    "namerica": 2.5,
    "asia": 2.1,
    "lamerica": 1.2,
    "meast": 0.2,
    "africa": 0.1
  }, {
    "year": "2004",
    "europe": 2.6,
    "namerica": 2.7,
    "asia": 2.2,
    "lamerica": 1.3,
    "meast": 0.3,
    "africa": 0.1
  }, {
    "year": "2005",
    "europe": 2.8,
    "namerica": 2.9,
    "asia": 2.4,
    "lamerica": 1.4,
    "meast": 0.3,
    "africa": 0.1
  }];

  // Create axes
  var categoryAxis = chart2.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "year";
  categoryAxis.title.text = "Local country offices";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 20;
  categoryAxis.renderer.cellStartLocation = 0.1;
  categoryAxis.renderer.cellEndLocation = 0.9;

  var valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());
  valueAxis.min = 0;
  valueAxis.title.text = "Expenditure (M)";

  // Create series
  function createSeries(field, name, stacked) {
    var series = chart2.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = field;
    series.dataFields.categoryX = "year";
    series.name = name;
    series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
    series.stacked = stacked;
    series.columns.template.width = am4core.percent(95);
  }

  createSeries("europe", "Europe", false);
  createSeries("namerica", "North America", true);
  createSeries("asia", "Asia", false);
  createSeries("lamerica", "Latin America", true);
  createSeries("meast", "Middle East", true);
  createSeries("africa", "Africa", true);

  // Add legend
  chart2.legend = new am4charts.Legend();


  chart3.data = [{
    "name": "John",
    "points": 35654,
    "color": chart3.colors.next(),
    "bullet": "https://www.amcharts.com/lib/images/faces/A04.png"
  }, {
    "name": "Damon",
    "points": 65456,
    "color": chart3.colors.next(),
    "bullet": "https://www.amcharts.com/lib/images/faces/C02.png"
  }, {
    "name": "Patrick",
    "points": 45724,
    "color": chart3.colors.next(),
    "bullet": "https://www.amcharts.com/lib/images/faces/D02.png"
  }, {
    "name": "Mark",
    "points": 13654,
    "color": chart3.colors.next(),
    "bullet": "https://www.amcharts.com/lib/images/faces/E01.png"
  }];

  // Create axes
  var categoryAxis = chart3.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "name";
  categoryAxis.renderer.grid.template.disabled = true;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.renderer.inside = true;
  categoryAxis.renderer.labels.template.fill = am4core.color("#fff");
  categoryAxis.renderer.labels.template.fontSize = 20;

  var valueAxis = chart3.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.grid.template.strokeDasharray = "4,4";
  valueAxis.renderer.labels.template.disabled = true;
  valueAxis.min = 0;

  // Do not crop bullets
  chart3.maskBullets = false;

  // Remove padding
  chart3.paddingBottom = 0;

  // Create series
  var series = chart3.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueY = "points";
  series.dataFields.categoryX = "name";
  series.columns.template.propertyFields.fill = "color";
  series.columns.template.propertyFields.stroke = "color";
  series.columns.template.column.cornerRadiusTopLeft = 15;
  series.columns.template.column.cornerRadiusTopRight = 15;
  series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/b]";

  // Add bullets
  var bullet = series.bullets.push(new am4charts.Bullet());
  var image = bullet.createChild(am4core.Image);
  image.horizontalCenter = "middle";
  image.verticalCenter = "bottom";
  image.dy = 20;
  image.y = am4core.percent(100);
  image.propertyFields.href = "bullet";
  image.tooltipText = series.columns.template.tooltipText;
  image.propertyFields.fill = "color";
  image.filters.push(new am4core.DropShadowFilter());

  chart4.data = [{
    "name": "The first",
    "value": 600
  }, {
    "name": "The second",
    "value": 300
  }, {
    "name": "The third",
    "value": 200
  }, {
    "name": "The fourth",
    "value": 180
  }, {
    "name": "The fifth",
    "value": 50
  }, {
    "name": "The sixth",
    "value": 20
  }, {
    "name": "The seventh",
    "value": 10
  }];

  var series = chart4.series.push(new am4charts.FunnelSeries());
  series.colors.step = 2;
  series.dataFields.value = "value";
  series.dataFields.category = "name";
  series.alignLabels = true;
  series.orientation = "horizontal";
  series.bottomRatio = 1;

  chart4.legend = new am4charts.Legend();
  chart4.legend.position = "top";
</script>

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

@endsection
