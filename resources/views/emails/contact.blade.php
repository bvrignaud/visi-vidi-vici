@component('mail::message')
# Nouveau message via le formulaire de contact
* Nom : {{ $name }}
* Email : {{ $email }}
* Objet : {{ $subject }}
* Message : {{ $content }}
@endcomponent
