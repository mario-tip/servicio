@extends("layouts.master")

@section("styles")
    {!!Html::style("/assets/global/plugins/datatables/datatables.min.css")!!}
    {{--{!! Html::style("/assets/css/main.css") !!}--}}
    {!! Html::style("/assets/css/aid.css") !!}
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
                <a href="{!!URL::to('/analytics_incident')!!}">Incidents</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{!!URL::to('/aid')!!}">Attention of incidents</a>
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
                        <i class=" icon-bubble font-green-600"></i>
                        <span class="caption-subject bold font-green-600">Attention of incidents</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">

                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th class="center">who registered?</th>
                            <th class="center">Asset</th>
                            <th class="center">Location</th>
                            <th class="center">Preference</th>
                            <th class="center">Incident type</th>
                            <th class="center">Hour</th>
                            <th class="center">Date</th>
                            <th class="center">Technical</th>
                            <th class="center">Status</th>
                            @if(userHasPermission("mostrar_consulta_atencion_incidencias")) 
                            <th class="center">Actions</th>
                            @endif 
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($incidents as $incident)
                            <tr>
                                <td class="center"> {{($incident->person)?$incident->person->name:''}} {{($incident->person)?$incident->person->father_last_name:''}}
                                    {{($incident->person)?$incident->person->mother_last_name:''}} </td>
                                <td class="center"> {{($incident->asset)?$incident->asset->name:''}} </td>
                                <td class="center"> {{$incident->location}} </td>
                                @if($incident->priority == 0)
                                  <td class="center">
                                    <span class="label label-sm label-hazard">High</span>
                                  </td>
                                @elseif($incident->priority == 1)
                                  <td class="center">
                                    <span class="label label-sm label-danger">Medium</span>
                                  </td>
                                @else
                                  <td class="center">
                                    <span class="label label-sm label-warning">Low</span>
                                  </td>
                                @endif
                                @if($incident->type == 0)
                                    <td class="center"> Clean </td>
                                @else
                                    <td class="center"> Repair </td>
                                @endif
                                <td class="center"> {{$incident->suggested_time}}  </td>
                                <td class="center"> {{\Carbon\Carbon::parse($incident->suggested_date)->format('d-m-Y')}} </td>
                                <td class="center"> {{$incident->technician}} </td>
                                <td class="center">
                                  @if ($incident->status == "Pending")
                                    <span class="label label-sm label-info">{{$incident->status}}</span>
                                  @else
                                    <span class="label label-sm label-success">{{$incident->status}}</span>
                                  @endif
                                </td>
                                @if(userHasPermission("mostrar_consulta_atencion_incidencias"))
                                <td>
                                  <div>
                                    <a href="{!!URL::to('/incidents_datails/'.$incident->id)!!}" title="Show details"
                                       class="btn btn-circle btn-icon-only grey-silver ">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                  </div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    {!! Html::script("/assets/global/scripts/datatable.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/datatables.min.js") !!}
    {!! Html::script("/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js") !!}
    {!! Html::script("/assets/scripts/simplified_datatable.js") !!}
    <script type="application/javascript">
        $(document).ready(function(){
            $("#liAnalitycs").addClass("active");
            $("#liAnalyticsIncidents").addClass("active");

        });
    </script>
@endsection
