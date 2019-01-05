
@component('mail::message')
# Notification incident

Your incidence was successfully registered
# Incident detail:

@component('mail::table')
| Folio                | Date                           | Asset             |
| ---------------------|:------------------------------:| -----------------:|
| {{$incident->folio}} | {{$incident->suggested_date}}  | {{$asset->name}}  |

@endcomponent

@component('mail::button',["url" => "http://service.altatec.com.mx/incidents/"])
Show incident
@endcomponent

Thanks, {{$user->name}} <br>

@endcomponent
