<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rechercher des annonces') }}
        </h2>
    </x-slot>
    <div class="container">
    <br>
        <form method="POST" action="{{ route('searchName') }}" class="row justify-content-center" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <h4>Recherche par nom</h4>
                <br>
                <input type="text" class="form-control" id="name" name="name" placeholder="Rechercher par nom">
                <br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
        <br>
        <form method="POST" action="{{ route('searchPrice') }}" class="row justify-content-center" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <h4>Recherche par prix</h4>
                <br>
                <label for="pricemin">Entrer un prix minimum</label>
                <br><br>
                <input type="number" class="form-control" id="pricemin" name="pricemin" value="1">
                <br>
                <label for="pricemax">Entrer un prix maximum</label>
                <br><br>
                <input type="number" class="form-control" id="pricemax" name="pricemax" value="1000">
                <br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
        <br>
        <form method="POST" action="{{ route('searchLocalisation') }}" class="row justify-content-center" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <h4>Recherche par localisation</h4>
                <br>
                <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Rechercher par localisation">
                <br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>
</x-app-layout>