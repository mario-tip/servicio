
@component('mail::message')
# Notification incident

A new incidence
# Incident detail:

@component('mail::table')
| Folio                | Date                           | Asset             | Who registered? |
| ---------------------|:------------------------------:| -----------------:|----------------:|
| {{$incident->folio}} | {{$incident->suggested_date}}  | {{$asset->name}}  | {{$user->name}} |

@endcomponent

@component('mail::button',["url" => "http://service.altatec.com.mx/service-orders/create/" . $incident->id ])
Generate order service 
@endcomponent

Thanks, {{$user_admin_incident->name}} <br>

@endcomponent
