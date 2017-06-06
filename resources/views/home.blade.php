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
        @foreach($places as $place)
            <a href="/places/{{$place->id}}">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{ $place->thumbnail }}" alt="Appartement à vendre">
                    <div class="caption">
                        <h3>{{ $place->title }}</h3>
                        <p>{{str_limit($place->description, 40)}}</p>
                        <p>Prix : {{ $place->price }} $</p>
                    </div>
                </div>
            </div>
            </a>
        @endforeach
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

