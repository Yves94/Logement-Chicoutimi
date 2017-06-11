@extends('layouts.header')
@section('title', 'Accueil')

@section('style')
    #map {
        height: 50%;
        min-height: 400px;
        width: 100%;
        margin-top: -22px;
    }

    #radius {
        margin: 40px 0;
    }

    #indicator {
        float: left;
        margin-top: 10px;
        font-size: 20px;
    }

    #noAnswer {
        font-size: 18px;
        margin-left: 15px;
        color: #a94442; 
    }

    .place-img-sm {
        width: 100px;
    }
@endsection

{{-- Google Map --}}
@section('map')
    <div id="map"></div>
@endsection

{{-- Corp de page --}}
@section('content')
    
    <span id="indicator">Rayon : {{ app('request')->input('radius') }} km</span>
    <input id="radius" type="range" value="{{ app('request')->input('radius') }}" data-init="{{ $init }}">

    <h3>Logemements à Proximités</h3>

    <div class="row">
        @if ($places)
            @foreach($places as $place)
                <a class="place-container" href="/places/{{ $place->id }}">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img class="place-img" src="{{ $place->thumbnail }}" alt="Appartement à vendre">
                            <div class="caption">
                                <h3 class="place-title">{{ $place->title }}</h3>
                                <p>{{ str_limit($place->description, 40) }}</p>
                                <p>Prix : <span class="place-price">{{ $place->price }}</span> $</p>
                                <input type="hidden" class="place-lat" value="{{ $place->latitude }}">
                                <input type="hidden" class="place-lng" value="{{ $place->longitude }}">
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div id="noAnswer">Aucun logement trouvé dans cette zone</div>
        @endif
    </div>
    
@endsection

{{-- Scripts pour la Google map  --}}
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp7A-v-XNZBbCiDGvLC6W6ojYJoRWdMdU&callback=initMap"></script>
<script>
    var pos; // Location de l'utilisateur courant
    var locations = []; // Tableau de la localisations des logements

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 48.3345165, lng: -71.2424132},
            zoom: 10,
            scrollwheel: false, // disable zoom when scrolling
        });

        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                console.log(locations);

                infoWindow.setPosition(pos);
                infoWindow.setContent('Je suis ici');
                map.setCenter(pos);

                $.each(locations, function(key, value) {
                    
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(value.lat, value.lng),
                        map: map,
                        title: value.title
                    });

                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });

                    var infowindow = new google.maps.InfoWindow({
                        content: '<img class="place-img-sm" src="' + value.img + '"><h4>' + value.title + '</h4><p>Prix : ' + value.price + ' $</p><button class="place-details btn btn-default" data-href="' + value.link + '" style="width:100%">Détails</button>'
                    });

                });

                // Initialise la map au bon endroit avec un radius
                if (!$('#radius').data('init')) {
                    $('#radius').change();
                }

            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
    }

    $(function () {

        $('#radius').on('change', function() {
            window.location.href = "http://127.0.0.1:8001/?lat=" + pos.lat + "&long=" + pos.lng + "&radius=" + $(this).val();
        });

        if($('#radius').data('init')) {
            
            $('.place-container').each(function(key, value) {
                var data = {};
                data.link = $(this).attr('href');
                data.img = $(this).find('.place-img').attr('src');
                data.title = $(this).find('.place-title').html();
                data.lat = $(this).find('.place-lat').val();
                data.lng = $(this).find('.place-lng').val();
                data.price = $(this).find('.place-price').html();
                locations.push(data);
            });
        }
        
    });

    $(document).on('input', '#radius', function() {
        $('#indicator').html('Rayon : ' + $(this).val() + ' km');
    });

    $(document).on('click', '.place-details', function() {
        window.location.href = $(this).data('href');
    });
</script>

    