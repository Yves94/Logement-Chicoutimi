@extends('layouts.header')
@section('title', 'Vendre')

@section('style')
    img {
        float: left;
        margin-right: 20px;
    }

    .price {
        float: right;
        margin-top: -37px;
        font-weight: bold;
    }

    .description {
        height: 120px;
    }

    .description p {
        text-align: justify;
    }
@endsection

@section('content')
    <img src="{{ $place->thumbnail }}">

    <h3 class="title">{{ $place->title }}</h3>
    <h3 class="price">{{ $place->price }} $</h3>
    <hr>
    <h4>Adresse : {{ $place->address }}, Chicoutimi</h4><br>
    <div class="description">
        <p>{{ $place->description }}</p>
    </div>
    <button class="btn btn-default">Contacter le vendeur</button>

@endsection