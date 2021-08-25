<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier votre annonce') }}
        </h2>
    </x-slot>
    <div class="container">
        <br><br>
        <form method="POST" action="{{ route('updateAd', ['id' => $editAds->id]) }}" class="row justify-content-center" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titre de l'annonce</label>
                <br><br>
                <input type="text" class="form-control" id="title" name="title" value="{{ $editAds->title }}">
                <br>
            </div>
            <div class="form-group">
                <label for="price">Prix de votre bien</label>
                <br><br>
                <input type="text" class="form-control" id="price" name="price" value=" {{ $editAds->price }}">
                <br>
            </div>
            <div class="form-group">
                <label for="localisation">Votre localisation</label>
                <br><br>
                <input type="text" class="form-control" id="localisation" name="localisation" value="{{ $editAds->localisation }}">
                <br>
            </div>
            <div class="form-group">
                <label for="description">Description de votre annonce</label>
                <br><br>
                <textarea class="form-control" id="description" name=description rows="3">{{ $editAds->description }}</textarea>
                <br>
            </div>
            <br><br>
            <div class="form-group">
                <label for="photo">Photo de votre bien</label>
                <br><br>
                <input type="file" class="form-control-file" id="photo" name="photo">
                <br>
            </div>
            <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
</x-app-layout>