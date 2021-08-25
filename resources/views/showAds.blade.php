<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les annonces') }}
        </h2>
    </x-slot>
    <div class="container">
    <br>
        @foreach ($ads as $ad)
        <div class="row justify-content-center">
        <div class="card" style="width: 72rem;">
            <img src="{{ asset('storage') }}/{{ $ad->photo }}" class="card-img-top" style="width: 250px; text-align: center;" alt=".">
            <div class="card-body">
                <h5 class="card-title">Titre : {{ $ad->title }}</h5>
                <p class="card-text">Prix : {{ $ad->price }}€</p>
                <p class="card-text">Localisation : {{ $ad->localisation }}</p>
                <p class="card-text">Description : {{ $ad->description }}</p>
                <p class="card-text">Crée {{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</p>
                <a href="#" class="btn btn-primary">Acheter</a>
            </div>
        </div>
        </div>
        <br>
        @endforeach
        {{ $ads->links() }}
    </div>
</x-app-layout>
