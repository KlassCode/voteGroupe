@component('mail::message')
# VoteConnect Invitation

{{$candidate->fullname}}, vous avez été invité à participer à l'élection {{$candidate->election->title}} 
sur la plateforme voteConnect organise par {{$candidate->election->user->name}}.
Appuyer sur le bouton "Valider" pour confirmer votre présence.

@component('mail::button', ['url' => route('candidate.confirm',[$candidate->id])])
Valider
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

