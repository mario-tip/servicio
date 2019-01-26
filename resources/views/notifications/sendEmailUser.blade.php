
@component('mail::message')

# Notifications service order

The service order was created successfully
# Service order detail:

@component('mail::table')
| Shet number               | Date                      | Hour                   |      Technician        |
| --------------------------|:-------------------------:| ----------------------:|-----------------------:|
| {{$orderService->folio}}  | {{$orderService->date}}   | {{$orderService->time}}| {{$orderService->technician['name']}}|
@endcomponent

@component('mail::button',["url" => "http://service.altatec.com.mx/service-orders/".$orderService->id])
Show service order
@endcomponent

@endcomponent
