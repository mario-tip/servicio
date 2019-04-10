@extends("layouts.master")

@section("styles")
{{--{!! Html::style("/assets/css/main.css") !!}--}}

{{-- {!! Html::style("assets/global/plugins/jquery.fullcalendar/fullcalendar.css") !!} --}}

{{-- <style>
  .fc-event{
            font-size: 1em;
        }
    </style> --}}
@endsection

@section('breadcrumb')
@include('partials.message')
{{-- <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/maintenances')!!}">Administration of scheduled maintenance</a>
            </li>
        </ul>
    </div> --}}
@endsection

@section("page-content")
<div class="row content_container paddingForm">
  <div class="col-md-12">
    <div class="portlet light portlet-fit bordered">
      <div class="portlet-title topForm">
      </div>
      <p class="titleForm">Calendar of upcoming maintenance</p>
      <div class="portlet-body bodyForm">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="btn-group pull-right">
                @if(userHasPermission("crear_mantenimientos") )
                <a href="{{URL::route('maintenances.create')}}" class="btn btnList"><i class="fa fa-plus"></i> Add maintenance</a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            {{-- <div id="maintenance-calendar"> </div> --}}
            <div class="auto-jsCalendar material-theme" data-month-format="month YYYY"></div>
          </div>
          <div class="col-md-6">
            <p class="titleMaintenance">Tasks</p>
            <div class="panel-group d-accordion borderTasks">
              <div class="panel panel-default">
                <div class="panel-heading collapsed" data-toggle="collapse" data-parent=".d-accordion" href="#dia1">
                  <h4 class="panel-title">Day 1<i class="fa fa-chevron-up pull-right"></i></h4>
                </div>
                <div id="dia1" class="panel-collapse collapse">
                  <div class="panel-body">
                    <table style="width:100%">
                      <p class="tableSubtitle">Mantenimiento #1</p>
                      <tr>
                        <th>Equipment</th>
                        <td>Zebra</td>
                      </tr>
                      <tr>
                        <th>Building</th>
                        <td>A4</td>
                      </tr>
                      <tr>
                        <th>Area</th>
                        <td>Sis</td>
                      </tr>
                      <tr>
                        <th>Section</th>
                        <td>A1</td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>13:20</td>
                      </tr>
                    </table>
                    <table style="width:100%">
                      <p class="tableSubtitle">Mantenimiento #2</p>
                      <tr>
                        <th>Equipment</th>
                        <td>Zebra</td>
                      </tr>
                      <tr>
                        <th>Building</th>
                        <td>A4</td>
                      </tr>
                      <tr>
                        <th>Area</th>
                        <td>Sis</td>
                      </tr>
                      <tr>
                        <th>Section</th>
                        <td>A1</td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>13:20</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading collapsed" data-toggle="collapse" data-parent=".d-accordion" href="#Dia2">
                  <h4 class="panel-title">Day 2<i class="fa fa-chevron-up pull-right"></i></h4>
                </div>
                <div id="Dia2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <table style="width:100%">
                      <p class="tableSubtitle">Mantenimiento #1</p>
                      <tr>
                        <th>Equipment</th>
                        <td>Zebra</td>
                      </tr>
                      <tr>
                        <th>Building</th>
                        <td>A4</td>
                      </tr>
                      <tr>
                        <th>Area</th>
                        <td>Sis</td>
                      </tr>
                      <tr>
                        <th>Section</th>
                        <td>A1</td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>13:20</td>
                      </tr>
                    </table>
                    <table style="width:100%">
                      <p class="tableSubtitle">Mantenimiento #2</p>
                      <tr>
                        <th>Equipment</th>
                        <td>Zebra</td>
                      </tr>
                      <tr>
                        <th>Building</th>
                        <td>A4</td>
                      </tr>
                      <tr>
                        <th>Area</th>
                        <td>Sis</td>
                      </tr>
                      <tr>
                        <th>Section</th>
                        <td>A1</td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>13:20</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading collapsed" data-toggle="collapse" data-parent=".d-accordion" href="#day3">
                  <h4 class="panel-title">Day 3 <i class="fa fa-chevron-up pull-right"></i></h4>
                </div>
                <div id="day3" class="panel-collapse collapse">
                  <div class="panel-body">
                    <table style="width:100%">
                      <p class="tableSubtitle">Mantenimiento #1</p>
                      <tr>
                        <th>Equipment</th>
                        <td>Zebra</td>
                      </tr>
                      <tr>
                        <th>Building</th>
                        <td>A4</td>
                      </tr>
                      <tr>
                        <th>Area</th>
                        <td>Sis</td>
                      </tr>
                      <tr>
                        <th>Section</th>
                        <td>A1</td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>13:20</td>
                      </tr>
                    </table>
                    <table style="width:100%">
                      <p class="tableSubtitle">Mantenimiento #2</p>
                      <tr>
                        <th>Equipment</th>
                        <td>Zebra</td>
                      </tr>
                      <tr>
                        <th>Building</th>
                        <td>A4</td>
                      </tr>
                      <tr>
                        <th>Area</th>
                        <td>Sis</td>
                      </tr>
                      <tr>
                        <th>Section</th>
                        <td>A1</td>
                      </tr>
                      <tr>
                        <th>Time</th>
                        <td>13:20</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <div class="modal fade" id="maintenance-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mantenimientos programados</h4>
                </div>
                <div class="modal-body" id="bodyMaintenance">
                    <div class="form-group" id="maintenance-list">
                        <h4 id="titulo"></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"
id="token">
<button type="button" class="btn red " data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div> --}}
@endsection

@section("scripts")
{!! Html::script('assets/global/plugins/jquery.fullcalendar/lib/moment.min.js') !!}
{!! Html::script('assets/global/plugins/jquery.fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('assets/global/plugins/jquery.fullcalendar/lang/en-ca.js') !!}

<script type="application/javascript">
  $(document).ready(function() {
    $("#liMaintenances").addClass("active");
    $("#liHelpDesk").addClass("active");

    var token = $("#token").val();

    $(function() {


      $('.i-accordion').on('show.bs.collapse', function(n) {
        $(n.target).siblings('.panel-heading').find('.panel-title i').toggleClass('fa-chevron-down fa-chevron-up');
      });
      $('.i-accordion').on('hide.bs.collapse', function(n) {
        $(n.target).siblings('.panel-heading').find('.panel-title i').toggleClass('fa-chevron-up fa-chevron-down');
      });
    });


  });


  //Fullcalendar init
  // $('#maintenance-calendar').fullCalendar({
  //     header: {
  //         left:   'title',
  //         center: '',
  //         right:  'today, prev, next, prevYear, nextYear'
  //     },
  //     events: function(start, end, timezone, callback) {
  //         $.ajax({
  //             url:'/maintenances/search_dates',
  //             headers: {'X-CSRF-TOKEN': token},
  //             type: 'POST',
  //             dataSrc:"",
  //             success: function(data) {
  //                 var events = [];
  //                 $(data).each(function() {
  //                     if($(this).attr('pending')==1){
  //                         if($(this).attr('maintenance_time') == null){
  //                             events.push({
  //                                 id: $(this).attr('id'),
  //                                 title: $(this).attr('message'),
  //                                 start: $(this).attr('maintenance_date'),
  //                                 backgroundColor: '#ff0000',
  //                                 borderColor: '#ff0000'
  //                             });
  //                         }else{
  //                             events.push({
  //                                 id: $(this).attr('id'),
  //                                 title: $(this).attr('message') + ' ' + $(this).attr('maintenance_time'),
  //                                 start: $(this).attr('maintenance_date'),
  //                                 backgroundColor: '#ff0000',
  //                                 borderColor: '#ff0000'
  //                             });
  //                         }
  //                     }else{
  //                         events.push({
  //                             id: $(this).attr('id'),
  //                             title: $(this).attr('folio') + ' ' + $(this).attr('notes') + ' ' + $(this).attr('maintenance_time'),
  //                             start: $(this).attr('maintenance_date')
  //                         });
  //                     }
  //                 });
  //                 callback(events);
  //             }
  //         });
  //     },
  //     eventClick:  function(event, jsEvent, view) {
  //         /*$('#titulo').html(event.title);
  //         $('#maintenance-modal').modal();*/
  //
  //         window.location = "/maintenances/" + event.id;
  //     },
  //     eventLimit: true,
  //     views: {
  //         month: {
  //             eventLimit: 7
  //         }
  //     }
  // });
</script>
@endsection
