@extends('layouts.header')
@section('title', 'Vendre')

@section('style')
    #map {
        height: 50%;
        min-height: 200px;
        width: 100%;
        margin-top: -22px;
    }
@endsection

@section('content')
    <h3>Vendre un logement</h3>

    <br>

    <form method="post" action="#">
        <div class="form-group">
            <label for="title">Titre de l'annonce</label>
            <input type="text" class="form-control" id="title" placeholder="Titre. Max 20 caractères">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" placeholder="Description. Max 200 caractères"></textarea>
        </div>


        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="adresse1">Numéro civil</label>
                    <input type="number" class="form-control" id="adresse1" placeholder="Numéro Civil">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="adresse2">Nom de la rue</label>
                    <input type="text" class="form-control" id="adresse2" placeholder="Nom de la rue">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="adresse3">Ville</label>
                    <input type="text" class="form-control" id="adresse3" value="Chicoutimi" disabled="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="adresse4">Code Postal</label>
                    <input type="text" class="form-control" id="adresse4" placeholder="Code Postal">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="text" class="form-control" id="lat" disabled="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="lng">Longitude</label>
                    <input type="text" class="form-control" id="lng" disabled="">
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

        <button class="btn btn-default">Poster mon annonce</button>
    </form>
@endsection

{{-- Google Map --}}
@section('map')
    <div id="map"></div>
@endsection

@section('js')
{{-- Scripts pour la Google map  --}}
<script>
    
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 48.425073, lng: -71.058178},
        });
        var geocoder = new google.maps.Geocoder();

        $('#adresse2').blur(function() {
            geocodeAddress(geocoder, map);
        });
        
    }

    function geocodeAddress(geocoder, resultsMap) {
        var num = document.getElementById('adresse1').value;
        var address = document.getElementById('adresse2').value;
        geocoder.geocode({'address': num + ', ' + address + ', Chicoutimi'}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
                $('#lat').val(results[0].geometry.location.lat());
                $('#lng').val(results[0].geometry.location.lng());
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

</script>
@endsection