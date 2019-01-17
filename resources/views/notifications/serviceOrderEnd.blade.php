
@component('mail::message')

# Notifications service order finished

The service order was successfully completed
# Service order detail:

@component('mail::table')
|       Shet number          |           Resolution Date          |         Resolution Hour            |      Technician                       |
| ---------------------------|:----------------------------------:| ----------------------------------:|--------------------------------------:|
| {{$service_order->folio}}  | {{$service_order->resolution_date}}| {{$service_order->resolution_time}}| {{$service_order->technician['name']}}|
@endcomponent

@component('mail::button',["url" => "http://service.altatec.com.mx/service-orders/".$service_order->id])
Show service order
@endcomponent

@endcomponent
