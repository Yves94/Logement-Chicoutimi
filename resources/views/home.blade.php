@extends('layouts.header')
@section('title', 'Accueil')

@section('style')
    #map {
        height: 50%;
        min-height: 400px;
        width: 100%;
        margin-top: -22px;
    }
@endsection

{{-- Google Map --}}
@section('map')
    <div id="map"></div>
@endsection

{{-- Corp de page --}}
@section('content')

    <h3>Logemements à Proximités</h3>

    <div class="row">
        @for ($i = 0; $i < 6; $i++)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="http://lorempixel.com/350/250/city" alt="Appartement à vendre">
                    <div class="caption">
                        <h3>Titre de la vente</h3>
                        <p>Description brève...</p>
                        <p>Prix : 250.000 $</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    
@endsection

{{-- Scripts pour la Google map  --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp7A-v-XNZBbCiDGvLC6W6ojYJoRWdMdU&callback=initMap"></script>
<script>
    function initMap() {
        var here = {lat: 48.4201407, lng: -71.0443195};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: here
        });
        var marker = new google.maps.Marker({
            position: here,
            map: map
        });
    }
</script>

