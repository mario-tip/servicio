@extends("layouts.master")

@section("styles")
    {{--{!! Html::style("/assets/css/main.css") !!}--}}

    {!! Html::style("assets/global/plugins/jquery.fullcalendar/fullcalendar.css") !!}

    <style>
        .fc-event{
            font-size: 1em;
        }
    </style>
@endsection

@section('breadcrumb')
    @include('partials.message')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{!!URL::to('/')!!}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/maintenances')!!}">Administración de mantenimientos programados</a>
            </li>
        </ul>
    </div>
@endsection

@section("page-content")
    <div class="row content_container">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold">Calendario de próximos mantenimientos</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <a href="{{URL::route('maintenances.create')}}" class="btn btn-circle green"><i class="fa fa-plus"></i> Registrar mantenimiento</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div id="maintenance-calendar"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="maintenance-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <button type="button" class="btn red " data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script('assets/global/plugins/jquery.fullcalendar/lib/moment.min.js') !!}
    {!! Html::script('assets/global/plugins/jquery.fullcalendar/fullcalendar.min.js') !!}
    {!! Html::script('assets/global/plugins/jquery.fullcalendar/lang/es.js') !!}

    <script type="application/javascript">
        $(document).ready(function(){
            $("#liMaintenances").addClass("active");

            var token= $("#token").val();

            //Fullcalendar init
            $('#maintenance-calendar').fullCalendar({
                header: {
                    left:   'title',
                    center: '',
                    right:  'today, prev, next, prevYear, nextYear'
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url:'/maintenances/search_dates',
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'POST',
                        dataSrc:"",
                        success: function(data) {
                            var events = [];
                            $(data).each(function() {
                                if($(this).attr('pending')==1){
                                    if($(this).attr('maintenance_time') == null){
                                        events.push({
                                            id: $(this).attr('id'),
                                            title: $(this).attr('message'),
                                            start: $(this).attr('maintenance_date'),
                                            backgroundColor: '#ff0000',
                                            borderColor: '#ff0000'
                                        });
                                    }else{
                                        events.push({
                                            id: $(this).attr('id'),
                                            title: $(this).attr('message') + ' ' + $(this).attr('maintenance_time'),
                                            start: $(this).attr('maintenance_date'),
                                            backgroundColor: '#ff0000',
                                            borderColor: '#ff0000'
                                        });
                                    }
                                }else{
                                    events.push({
                                        id: $(this).attr('id'),
                                        title: $(this).attr('folio') + ' ' + $(this).attr('notes') + ' ' + $(this).attr('maintenance_time'),
                                        start: $(this).attr('maintenance_date')
                                    });
                                }
                            });
                            callback(events);
                        }
                    });
                },
                eventClick:  function(event, jsEvent, view) {
                    /*$('#titulo').html(event.title);
                    $('#maintenance-modal').modal();*/

                    window.location = "/maintenances/" + event.id;
                },
                eventLimit: true,
                views: {
                    month: {
                        eventLimit: 7
                    }
                }
            });
        });
    </script>
@endsection