@extends('layouts.header')
@section('title', 'Vendre')

@section('style')
    
@endsection

@section('content')
    <h3>Vendre un logement</h3>

    <br>

    <form>
        <div class="form-group">
            <label for="title">Titre de l'annonce</label>
            <input type="text" class="form-control" id="title" placeholder="Titre. Max 20 caractères">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" placeholder="Description. Max 200 caractères"></textarea>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adresse1">Numéro civil</label>
                    <input type="number" class="form-control" id="adresse1" placeholder="Numéro Civil">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adresse2">Nom de la rue</label>
                    <input type="text" class="form-control" id="adresse2" placeholder="Nom de la rue">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adresse3">Ville</label>
                    <input type="text" class="form-control" id="adresse3" value="Chicoutimi" disabled="">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" id="price" placeholder="Prix en dollars $$">
        </div>

        <div class="form-group">
            <label for="picture">Photo de l'annonce</label>
            <input type="file" class="form-control" id="picture">
        </div>
    </form>
@endsection