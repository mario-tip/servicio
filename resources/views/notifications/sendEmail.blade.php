
@component('mail::message')
{{-- {{ dd($orderService) }} --}}
# Notifications service order

You have a new service order,click on the following link
# Service order detail:

@component('mail::table')
| Shet number               | Date                      | Hour                   |
| --------------------------|:-------------------------:| ----------------------:|
| {{$orderService->folio}}  | {{$orderService->date}}   | {{$orderService->time}}|

@endcomponent

@component('mail::button',["url" => "http://service.altatec.com.mx/service-orders/".$orderService->id])
Show service order
@endcomponent

Thanks {{$orderService->technician['name']}} <br>
{{-- {{ config('app.name') }} --}}
@endcomponent
