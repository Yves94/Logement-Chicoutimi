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
@endsection

{{-- Google Map --}}
@section('map')
    <div id="map"></div>
@endsection

{{-- Corp de page --}}
@section('content')
    
    <span id="indicator">Rayon : {{ app('request')->input('radius') }} km</span>
    <input id="radius" type="range" value="{{ app('request')->input('radius') }}">

    <h3>Logemements à Proximités</h3>

    <div class="row">
        @if ($places)
            @foreach($places as $place)
                <a href="/places/{{ $place->id }}">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="{{ $place->thumbnail }}" alt="Appartement à vendre">
                            <div class="caption">
                                <h3>{{ $place->title }}</h3>
                                <p>{{ str_limit($place->description, 40) }}</p>
                                <p>Prix : {{ $place->price }} $</p>
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

    $(function () {
        $('#radius').on('change', function() {
            window.location.href = "http://127.0.0.1:8081/?lat=48.4201407&long=-71.0443195&radius=" + $(this).val();
        });
    });

    $(document).on('input', '#radius', function() {
        $('#indicator').html('Rayon : ' + $(this).val() + ' km');
    });
</script>

