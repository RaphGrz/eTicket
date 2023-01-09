@extends('layouts.ap')

@section('cotent')

    <div class="menu">
        @if (Gate::allows('access-admin'))
            <a href="{{ route('profile.list') }}" class="retour">Retour</a>
        @endif
        <h1>{{ $user->name }} {{ $user->last_name }}</h1>
    </div>

    <div class="container-ticket">
        @include('profile.partials.update-profile-information-form')
    </div>

    @if(Gate::allows('access-admin'))
        <div class="container-ticket">
            @include('profile.partials.update-service-form')
        </div>
    @endif

    @if (Gate::allows('access-private', $user->id))
        <div class="container-ticket">
            @include('profile.partials.update-password-form')
        </div>
    @endif

    @if(Gate::allows('access-admin'))
        <div class="container-ticket">
            @include('profile.partials.delete-user-form')
        </div>
    @endif
   
@endsection