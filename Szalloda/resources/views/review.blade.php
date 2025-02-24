@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Értékelés írása</h1>
            <form action="/ertekeles" method="post" class="center">
                @csrf
                <label for="hotel">Melyik hotelünkhöz szeretne értékelést írni?</label>
                <br>
                <select name="hotel" id="hotel">
                    <option value="1">Budapest</option>
                    <option value="2">Nyíregyháza</option>
                    <option value="3">Debrecen</option>
                </select>
                <br>
                <label for="rating">Értékelés</label>
                <select name="star" id="star">
                    <option value="1">1★</option>
                    <option value="2">2★</option>
                    <option value="3">3★</option>
                    <option value="4">4★</option>
                    <option value="5">5★</option>
                </select>
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>

                <input type="submit" value="Közzététel">


            </form>
        </section>
    </div>
@endsection
