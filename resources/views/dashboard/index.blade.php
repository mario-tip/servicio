@extends('layouts.master')

@section("styles")

    {!! Html::style("/assets/css/dashboard.css") !!}
@endsection

@section('page-content')

  <div id="dashboard" class="row">

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div id="incidents_tile" class="tiles expand" >
              <a href="" >
                <div  class="tile bg-red-900 minizoom">
                  <div class="tile-body">
                    <i class="icon-earphones-alt"></i>
                  </div>
                  <div class="tile-object">
                    <div class="text-center">
                      <h4> <strong>Help Desk</strong> </h4>
                    </div>
                  </div>
                </div>
              </a>
            </div>
					</div>
				</div>
				<div class="portlet-body" style="display:none" >
          <div class="tiles">
            <a href="{!!URL::to('/incidents')!!}">
              <div id="rebote" class="tile bg-red-800 minizoom ">

                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong> Incidents </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('/help_service')!!}">
              <div class="tile bg-red-700 minizoom">

                <div class="tile-object">
                  <div class="text-center">
                    <h4><strong>Service</strong></h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('maintenances')!!}">
              <div class="tile bg-red-600 minizoom">

                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong>Maintenance </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

            <a href="{!!URL::to('/problems')!!}">
              <div class="tile bg-red-500 minizoom">

                <div class="tile-object">
                  <div class="text-center">
                    <h4> <strong>Problems </strong> </h4>
                  </div>
                </div>
              </div>
            </a>

          </div>
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet ">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand">
              <a href="" >
                <div class="tile bg-cian-800 minizoom">
                  <div class="tile-body">
                    <i class="icon-screen-desktop"></i>
                  </div>
                  <div class="tile-object">
                    <div class="text-center">
                      <h4> <strong>Assets</strong> </h4>
                    </div>
                  </div>
                </div>
              </a>
            </div>
					</div>
				</div>
				<div class="portlet-body" style="display:none">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="portlet-body">
              <div class="tiles">
                <a href="{!!URL::to('/actives')!!}">
                    <div class="tile bg-cian-700 minizoom">

                        <div class="tile-object">
                            <div class="text-center">
                                <h4> <strong> Asset List </strong> </h4>
                            </div>
                        </div>
                    </div>
                </a>

                  <a href="{!!URL::to('/actives')!!}">
                      <div class="tile bg-cian-600 minizoom">

                          <div class="tile-object">
                              <div class="text-center">
                                  <h4> <strong> Asset Groups </strong> </h4>
                              </div>
                          </div>
                      </div>
                  </a>

                  <a href="{!!URL::to('/parts')!!}">
                      <div class="tile bg-cian-500 minizoom">

                          <div class="tile-object">
                              <div class="text-center">
                                  <h4> <strong>Parts brochure </strong> </h4>
                              </div>
                          </div>
                      </div>
                  </a>

                  <a href="{!!URL::to('/service-orders')!!}">
                    <div class="tile bg-cian-400 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Asset Active</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

                  <a href="{!!URL::to('/service-orders')!!}">
                    <div class="tile bg-cian-300 minizoom">

                      <div class="tile-object">
                        <div class="text-center">
                          <h4><strong>Asset inactive</strong></h4>
                        </div>
                      </div>
                    </div>
                  </a>

              </div>
            </div>
          </div>
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet ">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand" >
              <a href="" >
                <div class="tile bg-teal-600 minizoom">
                  <div class="tile-body">
                    <i class="icon-graph"></i>
                  </div>
                  <div class="tile-object">
                    <div class="text-center">
                      <h4> <strong>Analytics</strong> </h4>
                    </div>
                  </div>
                </div>
              </a>
            </div>
					</div>
				</div>
				<div class="portlet-body" style="display:none">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="portlet-body">
              <div class="tiles">
                <a href="{!!route('reports.binnacle-service-orders')!!}">
                    <div class="tile bg-green-700 minizoom">

                        <div class="tile-object">
                            <div class="text-center">
                                <h4> <strong> Services </strong> </h4>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{!!URL::to('/analytics_incident')!!}">
                  <div class="tile bg-green-600  minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong>Incidents </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>
                
                <a href="{{route('reports.technician-tickets')}}">
                  <div class="tile bg-green-500 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>User Tikets</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('reports.customer-service-orders')}}">
                    <div class="tile bg-green-400  minizoom">

                        <div class="tile-object">
                            <div class="text-center">
                                <h4> <strong>Customer Serv. </strong> </h4>
                            </div>
                        </div>
                    </div>
                </a>

              </div>
            </div>
          </div>
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
			<!-- BEGIN Portlet PORTLET-->
			<div class="portlet ">
				<div id="flex_icon" class="portlet-title">
					<div class="caption tools">
            <div class="tiles expand" >
              <a href="" >
                <div class="tile bg-blue-900 minizoom">
                  <div class="tile-body">
                    <i class="icon-settings"></i>
                  </div>
                  <div class="tile-object">
                    <div class="text-center">
                      <h4> <strong>Admin Panel</strong></h4>
                    </div>
                  </div>
                </div>
              </a>
            </div>
					</div>
				</div>
				<div class="portlet-body" style="display:none">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="portlet-body">
              <div class="tiles">
                <a href="{{route('providers.index')}}">
                  <div class="tile bg-blue-800 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> Suppliers  </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('persons.index')}}" >
                  <div class="tile bg-blue-700 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> People </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('locations.index')}}" >
                  <div class="tile bg-blue-600 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4> <strong> Locations </strong> </h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('customers.index')}}">
                  <div class="tile bg-blue-500 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Customers</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{{route('projects.index')}}">
                  <div class="tile bg-blue-400 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Proyects</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

                <a href="{!!URL::to('/equipments')!!}">
                  <div class="tile bg-blue-300 minizoom">

                    <div class="tile-object">
                      <div class="text-center">
                        <h4><strong>Equipments</strong></h4>
                      </div>
                    </div>
                  </div>
                </a>

              </div>
            </div>
          </div>
				</div>
			</div>
			<!-- END Portlet PORTLET-->
		</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
     <div class="portlet-body">
       <div class="tiles">
           <a href="{!!URL::to('/equipments')!!}">
               <div class="tile bg-blue minizoom">

                   <div class="tile-body">
                       <i class="icon-notebook" ></i>
                   </div>
                   <div class="tile-object">
                       <div class="text-center">
                           <h4> <strong> Equipment  </strong> </h4>
                       </div>
                   </div>
               </div>
           </a>

           <a href="{!!URL::to('/actives')!!}">
               <div class="tile bg-blue-hoki minizoom">
                   <div class="tile-body">
                       <i class="icon-login"></i>
                   </div>
                   <div class="tile-object">
                       <div class="text-center">
                           <h4> <strong> Asset List </strong> </h4>
                       </div>
                   </div>
               </div>
           </a>

           <a href="{!!URL::to('/quotations')!!}">
               <div class="tile bg-blue-steel minizoom">
                   <div class="tile-body">
                     <i class="fa fa-quote-left"></i>
                   </div>
                   <div class="tile-object">
                       <div class="text-center">
                           <h4> <strong> Service </strong> </h4>
                       </div>
                   </div>
               </div>
           </a>

           <a href="{!!URL::to('/service-orders')!!}">
             <div class="tile bg-blue-madison minizoom">
               <div class="tile-body">
                 <i class="fa fa-wrench"></i>
               </div>
               <div class="tile-object">
                 <div class="text-center">
                   <h4><strong>Service</strong></h4>
                 </div>
               </div>
             </div>
           </a>

       </div>
     </div>
   </div>

   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
     <div class="portlet-body">
       <div class="tiles">
           <a href="{!!route('reports.binnacle-service-orders')!!}">
               <div class="tile bg-green minizoom">
                   <div class="tile-body">
                     <i class="icon-book-open"></i>
                   </div>
                   <div class="tile-object">
                       <div class="text-center">
                           <h4> <strong> Service </strong> </h4>
                       </div>
                   </div>
               </div>
           </a>

           <a href="{!!URL::to('/reports')!!}">
               <div class="tile bg-green-meadow minizoom">
                   <div class="tile-body">
                       <i class="icon-bar-chart"></i>
                   </div>
                   <div class="tile-object">
                       <div class="text-center">
                           <h4> <strong>Analytics </strong> </h4>
                       </div>
                   </div>
               </div>
           </a>

           <a href="{!!URL::to('/parts')!!}">
               <div class="tile bg-green-seagreen minizoom">
                   <div class="tile-body">
                     <i class="icon-grid"></i>
                   </div>
                   <div class="tile-object">
                       <div class="text-center">
                           <h4> <strong>Parts brochure </strong> </h4>
                       </div>
                   </div>
               </div>
           </a>

           <a href="{!!URL::to('/incidents')!!}">
             <div class="tile bg-green-turquoise minizoom">
               <div class="tile-body">
                 <i class="fa fa-exclamation-triangle"></i>
               </div>
               <div class="tile-object">
                 <div class="text-center">
                   <h4> <strong> Incidents </strong> </h4>
                 </div>
               </div>
             </div>
           </a>


       </div>
     </div>
   </div>

   <div id="three" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
     <div class="portlet-body">
       <div class="tiles">

           <a href="{!!URL::to('/aid')!!}">
             <div class="tile bg-grey-gallery minizoom">
               <div class="tile-body">
                 <i class="fa fa-pencil-square-o"></i>
               </div>
               <div class="tile-object">
                 <div class="text-center">
                   <h4> <strong>Incidents </strong> </h4>
                 </div>
               </div>
             </div>
           </a>

           <a href="{!!URL::to('maintenances')!!}">
             <div class="tile bg-grey-cascade minizoom">
               <div class="tile-body">
                 <i class="fa fa-calendar"></i>
               </div>
               <div class="tile-object">
                 <div class="text-center">
                   <h4> <strong>Maintenance </strong> </h4>
                 </div>
               </div>
             </div>
           </a>

           <a href="{!!URL::to('/catalogs')!!}">
             <div class="tile bg-grey-silver minizoom">
               <div class="tile-body">
                 <i class="fa fa-book"></i>

               </div>
               <div class="tile-object">
                 <div class="text-center">
                   <h4> <strong> Admin panel. </strong> </h4>
                 </div>
               </div>
             </div>
           </a>
       </div>
     </div>
   </div>




    {{-- <div id="test"> Hola</div> --}}
  </div>

@endsection

@section("scripts")
<script>

  // document.getElementById("incidents_tile").style.color = "blue";




  document.getElementById("incidents_tile").addEventListener("click", function( event ) {
    // display the current click count inside the clicked div
    // event.target.textContent = "click count: " + event.detail;

    // document.getElementById("rebote").style.color = "blue";
  }, false);

</script>
@endsection
